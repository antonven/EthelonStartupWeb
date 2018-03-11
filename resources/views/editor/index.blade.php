<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GrapesJS</title>
    <link rel="stylesheet" href="{{ asset('grapesjs/dist/css/grapes.min.css') }}">
    <link href="{{ asset('grapesjs/dist/grapesjs-preset-webpage.min.css') }}" rel="stylesheet">
    <script src="{{ asset('grapesjs/dist/grapes.min.js') }}"></script>
    <script src="{{ asset('grapesjs/dist/grapesjs-preset-webpage.min.js') }}"></script>
        <script src="{{ asset('grapesjs/dist/grapesjs-blocks-basic.min.js') }}"></script>
            <script src="{{ asset('adminitoAssets/assets/js/jquery.min.js') }}"></script>
    <style>
      body,
      html {
        height: 100%;
        margin: 0;
      }
    </style>
  </head>

  <body>
    <div id="gjs" style="height:0px; overflow:hidden;">
      {!! $template->html !!}
      <style>
      {{ $template->css }}
      </style>
    </div>

    <script type="text/javascript">
      var editor = grapesjs.init({
        showOffsets: 1,
        noticeOnUnload: 0,
        container: '#gjs',
        height: '100%',
        fromElement: true,
        assetManager: {
        upload: "{{ url('/editor/upload') }}"+"/"+"{{ $template_id }}",
        autoAdd: true,
        },
        storageManager: { 
          autoload: 0,
          autosave: true,
          contentTypeJson: true,
          type: 'remote',
          params: {},
          urlStore: "{{ url('/editor/store') }}"+"/"+"{{ $template_id }}"
        },
        styleManager : {
          sectors: [{
              name: 'General',
              open: false,
              buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom']
            },{
              name: 'Dimension',
              open: false,
              buildProps: ['width', 'height', 'max-width', 'min-height', 'margin', 'padding'],
            },{
              name: 'Typography',
              open: false,
              buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-shadow'],
            },{
              name: 'Decorations',
              open: false,
              buildProps: ['border-radius-c', 'background-color', 'border-radius', 'border', 'box-shadow', 'background'],
            },{
              name: 'Extra',
              open: false,
              buildProps: ['transition', 'perspective', 'transform'],
            }
          ],
        },
        plugins: ['gjs-blocks-basic'],
        pluginsOpts: {
          'gjs-blocks-basic': {
          }
        }
      });
      //add assets
        @foreach($assets as $asset)
          editor.AssetManager.add({
            src: "{{$asset->image_name}}",
            height: 150,
            width: 150
          });
        @endforeach

      //add save button
                editor.Panels.addButton
          ('options',
            [{
              id: 'save-db',
              className: 'fa fa-floppy-o',
              command: 'save-db',
              attributes: {title: 'Save DB'}
            }]
          );

              editor.Commands.add
        ('save-db',
        {
            run: function(editor, sender)
            {
              sender && sender.set('active'); // turn off the button
              editor.store();
              
                editor.on('storage:load', function(e) {
                    console.log('Loaded ', e);
              });

              editor.on('storage:store', function(e) {
                    console.log('Stored ', e);
              });         
            }
        });

    //components
    //editor.addComponents("{{ $template->components }}");
    //editor.setStyle("{{$template->style}}");

    </script>
  </body>
</html>
