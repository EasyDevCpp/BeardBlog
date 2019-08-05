const editorButtons = document.getElementsByClassName('wysiwyg-button');
const editorCanvas = document.getElementById('wysiwyg-canvas');
document.execCommand('enableObjectResizing', false);

const setAttribute = (element) => {
    if(element.dataset.attribute == 'createLink') {
        var link_url = prompt("Insert link's URL:", "");
        if(link_url == "" || link_url == null) {
            history.back();
        } else {
            document.execCommand(element.dataset.attribute, false, link_url);
        }
    } else if(element.dataset.attribute == 'formatBlock-p') {
        document.execCommand('formatBlock', false, 'p');
    } else if(element.dataset.attribute == 'heading-1') {
        document.execCommand('heading', false, 'h1');
    } else if(element.dataset.attribute == 'heading-2') {
        document.execCommand('heading', false, 'h2');
    } else if(element.dataset.attribute == 'heading-3') {
        document.execCommand('heading', false, 'h3');
    } else if(element.dataset.attribute == 'insertImage') {
        document.execCommand(element.dataset.attribute, false, img_path);
    } else {
        document.execCommand(element.dataset.attribute, false);
    }
}

for(let i = 0; i < editorButtons.length; i++) {
    editorButtons[i].addEventListener('click', function() {
        setAttribute(this);
    }, true);
}


function wysiwyg_post(path, params, method='post') {
    const form = document.createElement('form');
    form.method = method;
    form.action = path;
  
    for (const key in params) {
        if (params.hasOwnProperty(key)) {
            const hiddenField = document.createElement('input');
            hiddenField.type = 'hidden';
            hiddenField.name = key;
            hiddenField.value = params[key];
            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();
}