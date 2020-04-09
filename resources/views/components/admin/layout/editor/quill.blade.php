<div>
  <div
    id="editor_{{ $name }}"
    class="block w-full rounded-none transition duration-150 ease-in-out sm:text-sm sm:leading-5"
  ></div>
  <input
    data-raw-for="{{ $name }}"
    type="text"
    name="raw[{{ $name }}]"
    class="opacity-0 absolute inset-x-0 bottom-0 w-full h-px"
    style="font-size:1px"
  >
  <link href="https://unpkg.com/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
  <style>
    #editor_{{ $name }} .ql-editor {
      min-height: {{ $min_height ?? '200px' }};
    }
  </style>
  <script src="https://unpkg.com/quill@1.3.7/dist/quill.min.js"></script>
  <!-- Initialize Quill editor -->
  <script>
    const toolbarOptions_{{ $name }} = [
      [{ header: ['2', '3', false] }],
      ['bold', 'italic', 'underline', 'link', 'blockquote'],
      [
        { 'list': 'ordered' },
        { 'list': 'bullet' },
        { align: ['', 'center', 'right', 'justify'] }
      ],
      //['image', 'video'],
      ['clean'],
    ];
    const formats_{{ $name }} = [
      'header', 'bold', 'italic', 'underline', 'link', 'blockquote',
      { list: 'ordered' }, { list: 'bullet' }, 'align',
      //'image', 'video'
    ];
    const quill_{{ $name }} = new Quill('#editor_{{ $name }}', {
      theme: 'snow',
      placeholder: 'Vous pouvez écrire ici...',
      modules: {
        toolbar: toolbarOptions_{{ $name }}
      },
      formats: formats_{{ $name }},
      bounds: '#editor_{{ $name }}'
    });
    const input_{{ $name }} = document.querySelector('[data-raw-for="{{ $name }}"]');
    quill_{{ $name }}.on('text-change', function() {
      input_{{ $name }}.value = quill_{{ $name }}.root.innerHTML;
    });

    const form_{{ $name }} = input_{{ $name }}.form;
    form_{{ $name }}.addEventListener('submit', function() {
      if (quill_{{ $name }}.getText().trim() !== ('' || 'Vous pouvez écrire ici...')) {
        input_{{ $name }}.value = quill_{{ $name }}.root.innerHTML;
      }
      if (form_{{ $name }}.reportValidity()) {
        form_{{ $name }}.submit();
      }
    });
  </script>
</div>
