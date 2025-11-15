<style>
    .ck-powered-by {
        display: none !important;
    }

    .ck-editor__editable_inline {
        min-height: 150px;
        max-height: 500px;
        overflow: auto;
        resize: vertical;
        white-space: pre-wrap;
    }
</style>

<label for="{{ $name }}" class="form-label">{{ $label }}</label>
<textarea name="{{ $name }}" id="{{ $name }}" class="form-control @error($name) is-invalid @enderror">{{ $value ?? '' }}</textarea>

@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

@once
    <script src="{{ asset('app-assets/js/ckeditor.js') }}"></script>
@endonce

<script>
    (function() {
        const editorEl = document.getElementById('{{ $name }}');
        if (!editorEl) return;

        ClassicEditor
            .create(editorEl, {
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload').'?_token='.csrf_token() }}"
                }
            })
            .then(editor => {
                const editable = editor.ui.view.editable.element;

                // Apply editable styles
                editable.style.minHeight = '150px';
                editable.style.resize = 'vertical';
                editable.style.whiteSpace = 'pre-wrap';

                // Preserve multiple spaces while typing
                const viewDocument = editor.editing.view.document;
                viewDocument.on('keydown', (evt, data) => {
                    if (data.keyCode === 32) { // space key
                        const model = editor.model;
                        const selection = model.document.selection;

                        model.change(writer => {
                            writer.insertText('\u00A0', selection.getFirstPosition());
                        });

                        data.preventDefault();
                    }
                });

                // Submit handler
                const form = editorEl.closest('form');
                if (form) {
                    form.addEventListener('submit', function () {
                        editorEl.value = editor.getData();
                    });
                }
            })
            .catch(error => console.error(error));
    })();
</script>
