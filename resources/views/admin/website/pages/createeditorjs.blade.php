<x-admin.layout title="Nouvelle Page" category="website">
  <x-slot name="headerButtons">
    <x-admin.layout.header.button-primary onclick="document.forms['form'].submit()" class="group">
      <svg class="-ml-1 mr-2 h-5 w-5 text-indigo-50 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M11,9 L11,5 L9,5 L9,9 L5,9 L5,11 L9,11 L9,15 L11,15 L11,11 L15,11 L15,9 L11,9 Z M10,20 C15.5228475,20 20,15.5228475 20,10 C20,4.4771525 15.5228475,0 10,0 C4.4771525,0 0,4.4771525 0,10 C0,15.5228475 4.4771525,20 10,20 Z M10,18 C14.418278,18 18,14.418278 18,10 C18,5.581722 14.418278,2 10,2 C5.581722,2 2,5.581722 2,10 C2,14.418278 5.581722,18 10,18 Z" clip-rule="evenodd"></path>
      </svg>
      Créer
    </x-admin.layout.header.button-primary>
  </x-slot>
  <span id="saveButton">Sauvegarde</span>
  <form id="form" method="post" action="{{ route('admin.website.pages.store') }}">
    @csrf
    <x:admin.layout.form.input-text title="Titre" name="title" width="lg" />
    <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
      <label for="editorjs" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
        Contenu
      </label>
      <div class="mt-1 sm:mt-0 sm:col-span-2">
        <div class="max-w-lg rounded-md shadow-sm relative">
          <div
            id="editorjs"
            class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
          ></div>
        </div>
      </div>
    </div>
  </form>


  <x-slot name="scripts">
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script><!-- Header -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest"></script><!-- Image -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script><!-- Delimiter -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script><!-- List -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script><!-- Checklist -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script><!-- Quote -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script><!-- Embed -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script><!-- Table -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script><!-- Link -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/warning@latest"></script><!-- Warning -->

    <script>
      /**
       * Saving button
       */
      const saveButton = document.getElementById('saveButton');

      /**
       * To initialize the Editor, create a new instance with configuration object
       * @see docs/installation.md for mode details
       */
      const editor = new EditorJS({
        /**
         * Wrapper of Editor
         */
        holder: 'editorjs',

        /**
         * Height of Editor's bottom area that allows to set focus on the last Block
         */
        minHeight: 50,

        /**
         * Tools list
         */
        tools: {
          /**
           * Each Tool is a Plugin. Pass them via 'class' option with necessary settings {@link docs/tools.md}
           */
          header: {
            class: Header,
            inlineToolbar: ['link'],
            config: {
              placeholder: 'Titre'
            }
          },
          /**
           * Or pass class directly without any configuration
           */
          image: SimpleImage,
          list: {
            class: List,
            inlineToolbar: true,
          },
          checklist: {
            class: Checklist,
            inlineToolbar: true,
          },
          quote: {
            class: Quote,
            inlineToolbar: true,
            config: {
              quotePlaceholder: 'Texte de la citation',
              captionPlaceholder: 'Auteur de la citation',
            },
          },
          warning: Warning,
          delimiter: Delimiter,
          linkTool: LinkTool,
          embed: {
            class: Embed,
            inlineToolbar: false,
            services: {
              youtube: true,
            }
          },
          table: {
            class: Table,
            inlineToolbar: true,
          },
        },

        /**
         * Initial Editor data
         */
        data: {
          blocks: [
            {
              type: 'paragraph',
              data: {
                text: "Décrivez ici l'évènement"
              }
            },
          ]
        },
        onChange: function () {
          console.log('something changed');
        }
      });

      /**
       * Saving example
       */
      saveButton.addEventListener('click', function () {
        editor.save().then((outputData) => {
          console.log(outputData);
        });
      });
    </script>
  </x-slot>
</x-admin.layout>
