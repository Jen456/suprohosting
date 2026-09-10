import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const scriptDirectory = path.dirname(fileURLToPath(import.meta.url));
const root = path.dirname(scriptDirectory);
const previewPath = path.join(root, 'preview/index.html');
const preview = fs.readFileSync(previewPath, 'utf8');
const errors = [];

if (preview.includes('<?php')) errors.push('preview/index.html contiene PHP');
if (/lorem ipsum/i.test(preview)) errors.push('la vista previa contiene Lorem Ipsum');
if (/href=["']#["']/i.test(preview)) errors.push('la vista previa contiene enlaces vacíos');
if (!preview.includes('data-domain-search')) errors.push('falta el buscador de dominio');
if (!preview.includes('data-flow-modal')) errors.push('falta el configurador visual');
if ((preview.match(/<h1\b/gi) || []).length !== 1) errors.push('debe existir exactamente un h1');

const ids = new Map();
for (const match of preview.matchAll(/\bid="([^"]+)"/g)) {
  ids.set(match[1], (ids.get(match[1]) || 0) + 1);
}
for (const [id, count] of ids) {
  if (count > 1) errors.push(`id duplicado: ${id}`);
}

for (const match of preview.matchAll(/<a\b[^>]*\bhref="#([^"]+)"[^>]*>/g)) {
  if (!ids.has(match[1])) errors.push(`destino interno inexistente: #${match[1]}`);
}

for (const match of preview.matchAll(/<img\b([^>]*)>/g)) {
  if (!/\balt="[^"]*"/.test(match[1])) errors.push(`imagen sin texto alternativo: ${match[0].slice(0, 90)}`);
}

const localAssets = [...preview.matchAll(/(?:src|href)=["'](assets\/[^"']+)["']/g)].map(match => match[1]);
for (const asset of new Set(localAssets)) {
  if (!fs.existsSync(path.join(root, 'preview', asset))) errors.push(`falta el recurso ${asset}`);
}

const trackedSource = fs.readFileSync(path.join(root, '.gitignore'), 'utf8');
if (!trackedSource.includes('*.zip')) errors.push('.gitignore no bloquea paquetes ZIP');

const voidTags = new Set(['area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'link', 'meta', 'param', 'source', 'track', 'wbr']);
const structuralHtml = preview
  .replace(/<!--[\s\S]*?-->/g, '')
  .replace(/<script\b[\s\S]*?<\/script>/gi, '')
  .replace(/<style\b[\s\S]*?<\/style>/gi, '');
const stack = [];
for (const match of structuralHtml.matchAll(/<\/?([a-zA-Z][\w:-]*)\b[^>]*>/g)) {
  const token = match[0];
  const tag = match[1].toLowerCase();
  if (token.startsWith('<!') || voidTags.has(tag) || token.endsWith('/>')) continue;
  if (token.startsWith('</')) {
    const expected = stack.pop();
    if (expected !== tag) {
      errors.push(`etiqueta desbalanceada: se esperaba </${expected || 'ninguna'}> y apareció </${tag}>`);
      break;
    }
  } else {
    stack.push(tag);
  }
}
if (stack.length) errors.push(`etiquetas sin cerrar: ${stack.slice(-8).join(', ')}`);

if (errors.length) {
  console.error(errors.map(error => `- ${error}`).join('\n'));
  process.exit(1);
}

console.log(`Validación correcta: ${ids.size} ids únicos, ${new Set(localAssets).size} recursos locales y flujos esenciales presentes.`);
