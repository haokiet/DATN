
//profile
const src  = document.querySelector('.preview')
const ipnFileElement = document.querySelector('.input')
const resultElement = document.querySelector('.preview')
const validImageTypes = ['image/gif', 'image/jpeg', 'image/png']

ipnFileElement.addEventListener('change', function(e) {
    const files = e.target.files
    const file = files[0]
    const fileType = file['type']

    if (!validImageTypes.includes(fileType)) {
        resultElement.insertAdjacentHTML(
            'beforeend',
            '<span class="preview-img">Chọn ảnh đi :3</span>'
        )
        return
    }

    const fileReader = new FileReader()
    fileReader.readAsDataURL(file)

    fileReader.onload = function() {
        const url = fileReader.result

        src.setAttribute("src",url)

    }
})

//show sp

//them user
const pass = document.getElementById('pass');
const repass = document.getElementById('repass');
const showpass = document.getElementById('showpass');
const showpass2 = document.getElementById('showpass2');
const s1 = document.getElementById('s1');
const s2 = document.getElementById('s2');
s2.style.display='none';
showpass.addEventListener('click', () => {
    repass.setAttribute('type','text')
    pass.setAttribute('type','text')
    s1.style.display='none';
    s2.style.display='block';
});
showpass2.addEventListener('click', () => {
    repass.setAttribute('type','password')
    pass.setAttribute('type','password')
    s2.style.display='none';
    s1.style.display='block';

});

