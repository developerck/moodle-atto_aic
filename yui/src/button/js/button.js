var COMPONENTNAME = 'atto_aic',
    CSS = {
        TEXTINPUT: 'atto_aic_textentry',
        INPUTSUBMIT: 'atto_aic_promptentrysubmit',
        RESPONSE: 'atto_aic_response',
    };

TEMPLATE = '' +
    '<form class="atto_form">' +
    '<div class="row">' +
    '<div class="mb-1 col-md-12"><div class="alert alert-info">{{get_string "help" component}}</div></div>'+
    '<div class="mb-1 col-md-8">' +
    '<textarea class="form-control fullwidth text {{CSS.TEXTINPUT}}" type="text" ' +
    'id="{{elementid}}_atto_aic_prompttext"  placeholder="{{get_string "placeholder" component}}"></textarea>' +
    '</div>' +
    '<div class="mdl-align col-md-4">' +
    '<button type="button" class="btn btn-secondary  {{CSS.INPUTSUBMIT}}">{{get_string "buttonname" component}}</button>' +
    '</div>' +
    '</div><br/>' +
    '<div class=" row {{CSS.RESPONSE}}"></div>' +
    '</form>'

    ;
YUI.add('moodle-atto_aic-button', function (Y, NAME) {

    Y.namespace('M.atto_aic').Button = Y.Base.create('button', Y.M.editor_atto.EditorPlugin, [], {
        initializer: function () {
            if(this.get('is_allowed')){
            this.addButton({
                callback: this._toggleaic,
                icon: 'icon',
                iconComponent: 'atto_aic',
                tags: 'aic',
                buttonName: "aic"
            });
        }
        },
        _toggleaic: function () {
            // Handle the button click here.
            // You can fetch any passed in parameters here as follows:

            var dialogue = this.getDialogue({
                headerContent: M.util.get_string('header', COMPONENTNAME),
                width: '800px',
                focusAfterHide: true,
            });
            // Set the dialogue content, and then show the dialogue.
            dialogue.set('bodyContent', this._getDialogueContent());
            dialogue.show();
        },
        _getDialogueContent: function () {
            template = Y.Handlebars.compile(TEMPLATE);

            this._form = this._content = Y.Node.create(template({
                component: COMPONENTNAME,
                CSS: CSS
            }));

            this._currentSelection = this.get('host').getSelection();
            seltext = this._currentSelection[0].text();
            seltext = seltext.substr(0, seltext.length).slice(-1000);
            seltext = $.trim(seltext);
            if (seltext) {
                this._form.one('.' + CSS.TEXTINPUT).set("value", seltext);
            }

            this._form.one('.' + CSS.INPUTSUBMIT).on('click', this._generateText, this);

            return this._content;
        },

        _generateText: function () {
            // this._form.one('.' + CSS.INPUTSUBMIT).set("disabled",true);
            var text = this._form.one('.' + CSS.TEXTINPUT).get('value');
            if (text.length < 3) {
                this._form.one('.' + CSS.RESPONSE).setHTML("<div class='alert alert-danger'>"
                +M.util.get_string('textlength', COMPONENTNAME)+"</div>");
                return;
            }
            text = text.substr(0, text.length).slice(-1000); // intiall 1000 charcaters
            this._form.one('.' + CSS.RESPONSE).setHTML("<i class='fa fa-spinner' aria-hidden='true'></i>");

            $form_id = this._form.get('id');
            $form_id = $('#' + $form_id);
            ajaxurl = M.cfg.wwwroot + '/lib/editor/atto/plugins/aic/ajax.php';
            params = {
                sesskey: M.cfg.sesskey,
                action: 'get',
                text: text
            };

            Y.io(ajaxurl, {
                context: this,
                data: params,
                timeout: 50000,
                on: {
                    complete: this._loadContent,
                    start: function () {
                        $('.atto_aic_promptentrysubmit', $form_id).prop('disabled', true);
                        $('.' + CSS.RESPONSE, $form_id).html(
                            '<div class="spinner-grow text-success .aicspinner" role="status">'
                            +'<span class="sr-only">Loading...</span></div>'
                            + '<h4> Generating content ...</h4>'

                        );
                    },
                    failure: function () {
                        $('.' + CSS.RESPONSE, $form_id).html(
                            '<div class="alert alert-danger" role="alert"> '+M.util.get_string('error',COMPONENTNAME)+'</div>'
                        );

                    },
                    end: function () {
                        $('.aicspinner', $form_id).remove();
                        $('.atto_aic_promptentrysubmit', $form_id).prop('disabled', false);
                    },
                }
            });

        },
        _loadContent: function (id, preview) {
            if (preview.status == 200) {
                self = this;
                $form_id = this._form.get('id');
                $form_id = $('#' + $form_id);
                $('.atto_aic_response', $form_id).html(preview.response);
                self.get("host").setSelection(this._currentSelection);
                $('#inserttext1', $form_id).on('click', function () {
                    self.get('host').insertContentAtFocusPoint($('.response', '#text1').text());
                    self.markUpdated();

                });
                $('#inserttext2', $form_id).on('click', function () {
                    self.get('host').insertContentAtFocusPoint($('.response', '#text2').text());
                    self.markUpdated();

                });
                $('#inserttext3', $form_id).on('click', function () {
                    self.get('host').insertContentAtFocusPoint($('.response', '#text3').text());
                    self.markUpdated();

                });


            }
        }
    },{
        ATTRS: {
            is_allowed:false
        }
    });

}, '@VERSION@', { "requires": ["moodle-editor_aic-plugin"] });
