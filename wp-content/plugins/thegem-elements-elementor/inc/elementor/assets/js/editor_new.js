!function($, elementor){
	"use strict";
	var modules = elementor.modules;

	// ---------- Preset Control ----------
	var presetSelect = modules.controls.Select.extend({
		isPresetControl: function() {
			return "thegem_elementor_preset" === this.model.get("name") && -1 !== this.getWidgetName().indexOf("thegem-");
		},
		onReady: function() {
			window.thegemWidgets = window.thegemWidgets || {};
			this.loadPresets();
		},
		getElementSettingsModel: function() {
			return this.container.settings;
		},
		getWidgetName: function() {
			return this.getElementSettingsModel().get("widgetType");
		},
		isPresetDataLoaded: function() {
			return !_.isUndefined(window.thegemWidgets[this.getWidgetName()]);
		},
		loadPresets: function() {
			var item = this;
			if (this.isPresetControl() && !this.isPresetDataLoaded() && this.getWidgetName()) {
				$.post(thegemElementor.ajaxUrl, {
					action: 'thegem_elementor_get_preset_settings',
					widget: this.getWidgetName(),
					secret: thegemElementor.secret
				}).done(function(response) {
					if(response.success) item.setPresetData(response.data);
				});
			}
		},
		setPresetData: function(data) {
			window.thegemWidgets[this.getWidgetName()] = data;
		},
		getPresetData: function() {
			return _.isUndefined(window.thegemWidgets) ? {} : window.thegemWidgets[this.getWidgetName()] || {};
		},
		onBaseInputChange: function(e) {
			if(this.constructor.__super__.onBaseInputChange.apply(this, arguments), this.isPresetControl() && e.currentTarget.value) {
				e.stopPropagation();
				var data = this.getPresetData();
				this.applyPresetData(data[e.currentTarget.value]);
			}
		},
		applyPresetData: function(data) {
			var widgetControls = this.getElementSettingsModel().controls,
				item = this,
				collection = {};
			_.each(widgetControls, function(control, controlName) {
				if(item.model.get('name') !== controlName && data && !_.isUndefined(data[controlName])) {
					if(control.is_repeater) {
						var repeater = item.getElementSettingsModel().get(controlName).clone();
						repeater.each(function(subItem, subItemIndex) {
							_.isUndefined(data[controlName][subItemIndex]) || _.each(subItem.controls, function(subControl, subControlName) {
								item.isStyleTransferControl(subControl) && repeater.at(subItemIndex).set(subControlName, data[controlName][subItemIndex][subControlName]);
							});
						});
						collection[controlName] = repeater;
					}
					collection[controlName] = data[controlName];
				} else {
					if(item.isStyleTransferControl(control)) {
						collection[controlName] = control.default;
					}
				}
			});
			this.getElementSettingsModel().setExternalChange(collection);
			this.container.view.render();
			this.container.view.renderOnChange();
		},
		isStyleTransferControl: function(control) {
			return !_.isUndefined(control.style_transfer) && control.style_transfer ? control.style_transfer : "content" !== control.tab || control.selectors || control.prefix_class;
		}
	});
	elementor.addControlView("select", presetSelect);

	// ---------- Select2 Template Edit Link ----------
	var thegemOldSelect2onBaseInputChange =  modules.controls.Select2.prototype.onBaseInputChange;
	var select2TemplateEditLink = modules.controls.Select2.extend({
		isThegemTemplateSelect: function() {
			return !!this.model.get("thegem_template_link");
		},
		onReady: function() {
			this.thegemTemplateUpdateEditLink();
		},
		onBaseInputChange: function(e) {
			if(this.isThegemTemplateSelect()) {
				this.constructor.__super__.onBaseInputChange.apply(this, arguments);
				e.stopPropagation();
				this.thegemTemplateUpdateEditLink();
			} else {
				thegemOldSelect2onBaseInputChange.apply(this, arguments);
			}
		},
		thegemTemplateUpdateEditLink: function() {
			if(!this.isThegemTemplateSelect()) return;

			var control = this;
			let $inputWrapper = $('.elementor-control-input-wrapper', control.$el);
			let value = control.getCurrentValue() || 0;
			let link = thegemElementor.templateCreateLink;
			let templateType = this.model.get('thegem_template_type') || 'loop-item';
			link = link.replace('{type}', templateType);
			let label = thegemElementor.templateCreateLinkText;

			let $thegemTemplateEditLinkWrapper = $('.thegem-template-edit-link-wrapper', control.$el);
			if(!$thegemTemplateEditLinkWrapper.length) {
				$thegemTemplateEditLinkWrapper = $('<div class="thegem-template-edit-link-wrapper"><a class="thegem-template-edit-link elementor-button" href="#" target="_blank">' + label + '</a></div>').insertAfter($inputWrapper);
			}

			let $thegemTemplateEditLink = $('.thegem-template-edit-link', $thegemTemplateEditLinkWrapper);
			$thegemTemplateEditLink.off('click.thegem-template-edit-open click.thegem-template-create-open');

			if(value) {
				link = thegemElementor.templateEditLinkFormat.replace('{postID}', value);
				label = thegemElementor.templateEditLinkText;
				$thegemTemplateEditLink.on('click.thegem-template-edit-open', function(e) {
					e.preventDefault();
					const tabToken = Date.now() + '_' + Math.random().toString(36).substr(2, 9);
					sessionStorage.setItem('thegemTabToken', tabToken);
					const newTab = window.open($(this).attr('href'), '_blank');

					// Listen for updates via postMessage
					window.addEventListener('message', function handler(event){
						if(event.data && event.data.type === 'thegemTemplateUpdated' && event.data.id == value){
							control.container.view.render();
							control.container.view.renderOnChange();
							window.removeEventListener('message', handler);
						}
					}, false);
				});
			} else {
				let importLink = thegemElementor.templateImportLink.replace('{type}', templateType);
				let $thegemTemplateImportLink = $('<a class="thegem-template-import-link elementor-button" href="' + importLink + '" target="_blank">' + thegemElementor.templateImportLinkText + '</a>');
				if(templateType !== 'content') $thegemTemplateImportLink.insertAfter($thegemTemplateEditLink);

				$thegemTemplateEditLink.add($thegemTemplateImportLink).on('click.thegem-template-create-open', function(e) {
					e.preventDefault();

					// Generate token and store in sessionStorage
					const tabToken = Date.now() + '_' + Math.random().toString(36).substr(2, 9);
					sessionStorage.setItem('thegemTabToken', tabToken);

					// Open the pre-page (first page of Elementor editor)
					const newTab = window.open($(this).attr('href'), '_blank');

					// Listen for postMessage from child tab
					window.addEventListener('message', function handler(event){
						if(event.data && event.data.type === 'thegemTemplateCreated' && event.data.token === tabToken){
							const newID = event.data.newID;
							$('select', control.$el).append('<option value="' + newID + '" selected="selected"> ID = ' + newID + '</option>').trigger('change').select2();
							control.container.view.render();
							control.container.view.renderOnChange();
							window.removeEventListener('message', handler);
						}
					}, false);
					window.addEventListener('message', function handler(event){
						if(event.data && event.data.type === 'thegemTemplateUpdated' && event.data.token === tabToken) {
							control.container.view.render();
							control.container.view.renderOnChange();
							window.removeEventListener('message', handler);
						}
					}, false);
				});
			}

			$thegemTemplateEditLink.attr('href', link);
			$thegemTemplateEditLink.text(label);
		}
	});
	elementor.addControlView("select2", select2TemplateEditLink);

	// ---------- Elementor Document Loaded ----------
	elementor.on('document:loaded', function() {
		// Read token from URL or fallback to sessionStorage
		const urlParams = new URLSearchParams(window.location.search);
		const tabToken = urlParams.get('tabToken') || sessionStorage.getItem('thegemTabToken');

		// Notify parent tab if token exists
		if(tabToken && window.opener) {
			window.opener.postMessage({
				type: 'thegemTemplateCreated',
				token: tabToken,
				newID: elementor.config.initial_document.id
			}, '*');
		}

		elementor.channels.editor.on('TheGemApplyPreview', saveAndReload);

		elementor.saver.on('after:save', function(data) {
			console.log([window.opener, tabToken, urlParams.get('post')]);
			if(parseInt(data.config.document.revisions.current_id) === parseInt(elementor.config.initial_document.id)) {
				if(window.opener && tabToken && urlParams.get('post')) {
					console.log(tabToken);
					window.opener && window.opener.postMessage({
						type: 'thegemTemplateUpdated',
						id: urlParams.get('post'),
						token: tabToken
					}, '*');

					var closePopup = elementorCommon.dialogsManager.createWidget('confirm', {
						id: 'thegem-template-save-on-close',
						message: thegemElementor.templateClosePopupText,
						position: { my: 'center center', at: 'center center' },
						strings: {
							confirm: thegemElementor.templateClosePopupCloseText,
							cancel: thegemElementor.templateClosePopupCancelText
						},
						onConfirm: function() {
							window.close();
						}
					});
					closePopup.show();
				}
			}
		});
	});

	// ---------- Save and Reload ----------
	function saveAndReload() {
		$e.run('document/save/auto', {
			force: true,
			onSuccess: () => {
				elementor.dynamicTags.cleanCache();
				const isInitialDocument = elementor.config.initial_document.id === elementor.documents.getCurrentId();
				if(isInitialDocument){
					elementor.reloadPreview();
				} else {
					$e.internal('editor/documents/attach-preview');
				}
			}
		});
	}

}(window.jQuery, window.elementor);
