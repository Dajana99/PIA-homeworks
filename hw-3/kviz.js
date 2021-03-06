const question = document.querySelector('#question');
const choices = Array.from(document.querySelectorAll('.choice-text'));
const progressText = document.querySelector('#progressText');
const scoreText = document.querySelector('#score');
const progressBarFull = document.querySelector('#progressBarFull');

let currentQuestion = {}
let acceptingAnswers = true
let score = 0
let questionCounter = 0
let availableQuestions = []

let questions = [
  {
     question: "Kako se zove najveća tehnološka kompanija u Južnoj Koreji?",
     choice1: "Samsung",
     choice2: "Nokia",
     choice3: "LG",
     choice4: "Huawei",
     answer: 1,
  },
  {
     question: "Koliko udisaja dnevno uradi ljudsko telo?",
     choice1: "5000",
     choice2: "10 000",
     choice3: "20 000",
     choice4: "50 000",
     answer: 3,
  },
  {
     question: "Drugi svetski rat je poceo napadom Nemačke na?",
     choice1: "SSSR",
     choice2: "Italiju",
     choice3: "Poljsku",
     choice4: "Japan",
     answer: 3,
  },
  {
     question: "Koje godine je Kragujevac postao prestonica Srbije?",
     choice1: "1833",
     choice2: "1884",
     choice3: "1818",
     choice4: "1836",
     answer: 3,
  }
]

const SCORE_POINTS = 1
const MAX_QUESTIONS = 4

startGame = () => {
    questionCounter = 0
    score = 0
    availableQuestions = [...questions]
    getNewQuestion()
}

getNewQuestion = () => {
    if(availableQuestions.length === 0 || questionCounter > MAX_QUESTIONS) {
        localStorage.setItem('mostRecentScore', score)

        return window.location.assign('kraj.html')
    }

    questionCounter++
    progressText.innerText = `Pitanje ${questionCounter} od ${MAX_QUESTIONS}`
    progressBarFull.style.width = `${(questionCounter/MAX_QUESTIONS) * 100}%`
    
    const questionsIndex = Math.floor(Math.random() * availableQuestions.length)
    currentQuestion = availableQuestions[questionsIndex]
    question.innerText = currentQuestion.question

    choices.forEach(choice => {
        const number = choice.dataset['number']
        choice.innerText = currentQuestion['choice' + number]
    })

    availableQuestions.splice(questionsIndex, 1)

    acceptingAnswers = true
}

choices.forEach(choice => {
    choice.addEventListener('click', e => {
        if(!acceptingAnswers) return

        acceptingAnswers = false
        const selectedChoice = e.target
        const selectedAnswer = selectedChoice.dataset['number']

        let classToApply = selectedAnswer == currentQuestion.answer ? 'correct' : 'incorrect'

        if(classToApply === 'correct') {
            incrementScore(SCORE_POINTS)
        }

        selectedChoice.parentElement.classList.add(classToApply)

        setTimeout(() => {
            selectedChoice.parentElement.classList.remove(classToApply)
            getNewQuestion()

        }, 1000)
    })
})

incrementScore = num => {
    score +=num
    scoreText.innerText = score
}

startGame()
