import Picker from 'vanilla-picker';
const customPreloader = $("label.preloader-load");
const defaultPreloaderInputs = $("input[name='preloader']");
const preloaderBlock = $(".preview-preloader-block");
const bg = $("#bgPreview");
const section = $(".preview-block");

//preloader
$(this).empty();
$("input[name='preloaderFile']").change(function() {
    customPreloader.empty();
    customPreloader.addClass('preloader-pic-loaded');
    defaultPreloaderInputs.prop('checked', false);
    readURL(this, customPreloader);
    readURL(this, preloaderBlock);
    previewDisplayPreloader();
});

// $("input[name='preloader']").change(function () {
//     preloaderBlock.css('image-background', '');
// });

defaultPreloaderInputs.change(function () {
    customPreloader.removeClass('preloader-pic-loaded');
    preloaderBlock.css('background-image', 'url('+preloaderPath+'/'+$("input[name='preloader']:checked").val()+')')
    previewDisplayPreloader();
});

// Background

$("input[name='bgSize']").change(function () {
    let bgSize = $(this).val();
    bg.css('background-size', bgSize);
});

$("input[name='bgPosition']").change(function () {
    let bgPosition = $(this).val();
    bg.css('background-position', bgPosition);
});

$("input[name='bgRepeat']").change(function () {
    let bgRepeat = $(this).val();
    bg.css('background-repeat', bgRepeat);
});

$("input[name='bgPicture']").change(function() {
    readURL(this, bg);
});

$("input[name='bgAnimation']").change(function () {
});

$("input[name='bcBorder']").change(function () {
    let bcBorder = $(this).val();
    section.css('border', bcBorder + 'px solid #fff');
    previewDisplayContent();
});

$("select[name='previewPage']").change(function () {
    let previewPage = $(this).val();
    if(previewPage == 1) {
        previewDisplayIndex();
    }
    else if(previewPage == 2) {
        previewDisplayContent();
    }
    else if(previewPage == 3) {
        previewDisplayPreloader();
    }

});

$(document).ready(function () {
    $('.preview-base').show();
    $('.preview-index').hide();
    $('.preview-preloader').hide();
});

function previewDisplayIndex() {
    $('.preview-index').show();
    $('.preview-base').hide();
    $('.preview-preloader').hide();
}
function previewDisplayContent() {
    $('.preview-index').hide();
    $('.preview-base').show();
    $('.preview-preloader').hide();
}
function previewDisplayPreloader() {
    $('.preview-index').hide();
    $('.preview-base').hide();
    $('.preview-preloader').show();
}

function readURL(input, block) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            block.css('background-image', 'url('+e.target.result+')');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

const colorPickerWrappers = document.querySelectorAll('.color-picker');
for (const wrapper of [...colorPickerWrappers]) {
    let picker = null;

    wrapper.addEventListener('click', (event) => {
        console.log(wrapper.dataset.color);
        event.stopPropagation();
        if (!picker) {
            picker = new Picker({
                parent: wrapper,
                editor: true,
                editorFormat: 'rgb',
                popup: 'top',
                color: wrapper.dataset.color
            });

            picker.onChange = function(color) {
                $("input[name='"+wrapper.dataset.name+"']").val(color.rgbaString);
                wrapper.style.backgroundColor = color.rgbaString;
                wrapper.style.boxShadow = "0 0 10px rgba("+color.rgba[0]+", "+color.rgba[1]+", "+color.rgba[2]+", 0.5)";

                // Preview block
                // Background
                if(wrapper.dataset.name == 'bgColor') {
                    bg.css('background-color', color.rgbaString);
                }
                // Block content
                if(wrapper.dataset.name == 'bcBackground') {
                    section.css('background-color', color.rgbaString);
                    previewDisplayContent();
                }

            };
        }
        picker.show();
    });
}
