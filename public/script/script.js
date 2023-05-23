
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

