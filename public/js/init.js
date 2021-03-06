hostname = window.location.hostname
config = { width: 400, height: 300, refreshTime: 175 }

Webcam.set({
    width: config.width, // 4
    height: config.height, // 3
    image_format: 'jpeg',
    jpeg_quality: 70
})


Promise.all([
    faceapi.nets.tinyFaceDetector.loadFromUri('../models'),
]).then(Webcam.attach('#video'))

const video = document.querySelector('#video video')
let score = 0
video.addEventListener('play', () => {
    const canvas = faceapi.createCanvasFromMedia(video)
    document.body.append(canvas)
    const displaySize = { width: config.width, height: config.height }
    faceapi.matchDimensions(canvas, displaySize)
    setInterval(async () => {
        const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
        const resizedDetections = faceapi.resizeResults(detections, displaySize)
        canvas.getContext('2d').clearRect(0, 0, config.width, config.height)
        if (detections.length > 0) {
            score = detections[0].score
            if (score > 0.5){
                faceapi.draw.drawDetections(canvas, resizedDetections)
            }
        } else {
            score = 0
        }
    }, config.refreshTime)
})


async function postFormData(url, formData) {
    let data = await fetch(url, {
        method: "POST",
        body: formData
    })
        .then(res => {
            return res.json()
        })
        .then(data => {
            return data
        })
        .catch(err => err)
    return data
}