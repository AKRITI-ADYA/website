// --- IMPORTANT: ADD YOUR 10 DAILY QUESTIONS HERE ---
// Simply replace the content of this array with your new questions each day.
// Make sure to maintain the same structure for each question object.
const questions = [
    {
        questionText: "What is programming language?",
        options: ["Earth", "Mars", "Jupiter", "Saturn"],
        correctAnswerIndex: 2
    },
    {
        questionText: "What is the chemical symbol for water?",
        options: ["O2", "H2O", "CO2", "NaCl"],
        correctAnswerIndex: 1
    },
    {
        questionText: "what is software?",
        options: ["Charles Dickens", "William Shakespeare", "Jane Austen", "Mark Twain"],
        correctAnswerIndex: 1
    },
    {
        questionText: "What is header?",
        options: ["Beijing", "Seoul", "Tokyo", "Bangkok"],
        correctAnswerIndex: 2
    },
    {
        questionText: "How many continents are there?",
        options: ["5", "6", "7", "8"],
        correctAnswerIndex: 2
    },
    {
        questionText: "What is the smallest country in the world?",
        options: ["Monaco", "Vatican City", "San Marino", "Nauru"],
        correctAnswerIndex: 1
    },
    {
        questionText: "In which year did the Titanic sink?",
        options: ["1912", "1905", "1923", "1915"],
        correctAnswerIndex: 0
    },
    {
        questionText: "What is the boiling point of water in Celsius?",
        options: ["0°C", "50°C", "100°C", "212°C"],
        correctAnswerIndex: 2
    },
    {
        questionText: "What is the longest river in the world?",
        options: ["Nile", "Amazon", "Yangtze", "Mississippi"],
        correctAnswerIndex: 0
    },
    {
        questionText: "What is the square root of 64?",
        options: ["6", "7", "8", "9"],
        correctAnswerIndex: 2
    }
];

// --- QUIZ LOGIC (DO NOT CHANGE) ---

let currentQuestionIndex = 0;
let score = 0;

const quizContainer = document.getElementById('quiz-container');
const startQuizBtn = document.getElementById('start-quiz-btn');
const questionContainer = document.getElementById('question-container');
const questionTextElement = document.getElementById('question-text');
const optionsListElement = document.getElementById('options-list');
const quizStatusElement = document.getElementById('quiz-status');

startQuizBtn.addEventListener('click', startQuiz);

function startQuiz() {
    startQuizBtn.style.display = 'none';
    questionContainer.style.display = 'block';
    currentQuestionIndex = 0;
    score = 0;
    showQuestion();
}

function showQuestion() {
    if (currentQuestionIndex < questions.length) {
        const currentQuestion = questions[currentQuestionIndex];
        questionTextElement.textContent = `Question ${currentQuestionIndex + 1} of ${questions.length}: ${currentQuestion.questionText}`;
        optionsListElement.innerHTML = '';
        currentQuestion.options.forEach((option, index) => {
            const listItem = document.createElement('li');
            const button = document.createElement('button');
            button.textContent = option;
            button.addEventListener('click', () => checkAnswer(index));
            listItem.appendChild(button);
            optionsListElement.appendChild(listItem);
        });
    } else {
        showFinalScore();
    }
}

function checkAnswer(selectedIndex) {
    const currentQuestion = questions[currentQuestionIndex];
    const options = optionsListElement.querySelectorAll('button');

    options.forEach(button => button.disabled = true); // Disable buttons after an answer is selected

    if (selectedIndex === currentQuestion.correctAnswerIndex) {
        options[selectedIndex].classList.add('correct');
        score++;
    } else {
        options[selectedIndex].classList.add('incorrect');
        options[currentQuestion.correctAnswerIndex].classList.add('correct');
    }

    setTimeout(() => {
        currentQuestionIndex++;
        showQuestion();
    }, 1500); // Wait 1.5 seconds before showing the next question
}

function showFinalScore() {
    questionContainer.style.display = 'none';
    quizStatusElement.textContent = `Quiz completed! You scored ${score} out of ${questions.length}.`;
    startQuizBtn.style.display = 'block';
    startQuizBtn.textContent = 'Restart Quiz';
}