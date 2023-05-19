(function ($) {
    $(function () {
        $('body').on('grav-editor-ready', function () {
            var Instance = Grav.default.Forms.Fields.EditorField.Instance;
            Instance.addButton({
                tweet: {
                    identifier: 'tweet-cite',
                    title: 'Insert Tweet',
                    label: '<i class="fa fa-fw fa-twitter"></i>',
                    modes: ['gfm', 'markdown'],
                    action: function (_ref) {
                        const codemirror = _ref.codemirror, button = _ref.button, textarea = _ref.textarea;
                        button.on('click.editor.tweet-cite', function () {
                            const url = prompt("Enter the Tweet URL. E.g. https://twitter.com/jack/status/20");

                            if (url) {
                                const text = `[tweet url="${url}"][/tweet]`;

                                const pos = codemirror.getDoc().getCursor(true);
                                const posend = codemirror.getDoc().getCursor(false);

                                for (let i = pos.line; i < (posend.line + 1); i++) {
                                    codemirror.replaceRange(text + codemirror.getLine(i), { line: i, ch: 0 }, { line: i, ch: codemirror.getLine(i).length });
                                }

                                codemirror.setCursor({ line: posend.line, ch: codemirror.getLine(posend.line).length });
                                codemirror.focus();
                            }
                        });
                    }
                }
            });
        });
    });
})(jQuery);