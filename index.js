function progressBarSizes(windowWidth) {
    const progressBars = document.querySelectorAll('.progressBar')
    progressBars.forEach(elem => {
        const div = elem.querySelector('div')
        if (windowWidth > 1200) {
            const width = parseFloat(div.getAttribute('data-width')) * 15
            div.style.width = width + 'px'
        } else {
            const width = parseFloat(div.getAttribute('data-width')) * 8
            div.style.width = width + 'px'
        }
    })
}

function headerSize(windowWidth) {
    const bodyWidth = document.body.clientWidth
    const header = document.querySelector('header')
    header.style.width = bodyWidth + 'px'
}

(function init() {
    let basics = ""
    Object.entries(datas.basics).forEach(value => {
        if (value[0] === "name") {
            basics += `<h1>${value[0]}</h1>`
        } else {
            basics += `<img src='./assets/${value[0]}.ico'/> ${value[1]}<br>`
        }
    })
    document.querySelector('#basics').innerHTML = basics

    // let skills = ""
    // datas.skills.forEach(skill => {z
    //     skills += "{$skill->name} : <br> \
    //         <div class='progressBar'> \
    //         <div data-width='{$skill->level}'></div> \
    //         </div><br>"
    // })
    // document.querySelector('#skills').innerHTML = skills

    document.querySelector('#skills').setAttribute('data-initial-width', window.innerWidth.toString())
    progressBarSizes(window.innerWidth)
    headerSize(window.innerWidth)
})()

window.addEventListener('resize', function (e) {
    progressBarSizes(window.innerWidth)
    headerSize(window.innerWidth)
})