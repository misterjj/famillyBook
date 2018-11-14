require('croppie');

$(function() {
  $.fn.formCropper = function(options) {
    let settings = $.extend({
      // These are the defaults.
      name: "picture",
      selector: "#cropper",
      viewport: 200
    }, options );

    this.prepend('<input name="'+settings.name+'" type="hidden" />');
    let input = this.find('input[name="'+settings.name+'"]');
    let selector = $(settings.selector);
    if (selector.length > 0) {
      let selectorWidth = selector.width();
      selector.addClass('cropper').append("<div class='image-profile'></div><div class='upload-file-msg' style='height: "+selectorWidth+"px'></div><input type='file' class='upload-file-input' accept='image/jpeg'/>");
      let uploadMessage = selector.find('.upload-file-msg');
      let uploadFile = selector.find('.upload-file-input');

      let uploadCropp = $('.image-profile').croppie({
        enableExif: true,
        viewport: {
          width: settings.viewport,
          height: settings.viewport,
          type: 'square'
        },
        boundary: {
          width: Math.max(selectorWidth, settings.viewport),
          height: Math.max(selectorWidth, settings.viewport)
        }
      });
      uploadCropp.toggle();

      $(window).resize(function(){
        let selectorWidth = selector.width();
        uploadMessage.css('height', selectorWidth);

        uploadCropp.croppie('bind', {
          boundary: {
            width: Math.max(selectorWidth, settings.viewport),
            height: Math.max(selectorWidth, settings.viewport)
          }
        })
      });

      uploadMessage.click(function (event) {
        uploadFile.click();
      });
      uploadFile.on('change', function () {
        if (this.files && this.files[0]) {
          let reader = new FileReader();

          reader.onload = function (e) {
            uploadMessage.toggle();
            uploadCropp.toggle();
            uploadCropp.croppie('bind', {
              url: e.target.result
            })
          };

          reader.readAsDataURL(this.files[0]);
        }
        else {
          alert("Sorry - you're browser doesn't support the FileReader API");
        }
      });

      this.submit(function(){
        console.log('coucou');
        uploadCropp.croppie('result', {
          type: 'canvas',
          size: 'viewport'
        }).then(function (resp) {
          input.val(resp);
          console.log(resp);
        });
      });
    } else {
      console.log(settings.selector + ' not found');
    }
    return this;
  };
})