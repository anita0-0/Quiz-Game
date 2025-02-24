
<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Travel Quiz - Medium Level</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');
    body {
      font-family: Arial, sans-serif;
      background-color: black;
      color: #333;
      text-align: center;
      padding: 20px;
      background-image: url('medium4.jpg');
      height: 100vh;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    h1 {
      font-size: 3rem;

      font-family: 'Press Start 2P', cursive;
      color: white;
    }

    .quiz-container {

      background-color: rgba(255, 255, 255, 0.5); /* White background with transparency */
      border-radius: 8px;
      padding: 20px;
      max-width: 800px;
      margin: auto;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .question {
      font-size: 2rem;
      margin-bottom: 20px;
      color: black;
    }

    .options {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 10px;
    }

    .options button {
      flex: 0 0 48%;
      padding: 15px;
      border: none;
      border-radius: 5px;
      font-size: 1.2rem;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .options button.correct {
      background-color: green;
      color: white;
    }

    .options button.wrong {
      background-color: #A52A2A ;
      color: white;
    }

    .timer {
      font-size: 1.2rem;
      margin: 15px 0;
      color: black;
    }

    .score {
      font-size: 1.2rem;
      margin: 20px 0;
      color: black;
    }

    button {
      padding: 10px 20px;
      font-size: 1rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      background-color:  #6B8E23;
      color: white;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color:#8FBC8F;
    }

    /* Center the quiz completed box and restart button */
    .center-content {
      font-size: 2rem;
      border-radius: 6px;
      background-color: rgba(255, 255, 255, 0.5); /* White background with transparency */
      padding: 20px;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 4px 5px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
  
     /* Center the box in the viewport */
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
    
    .center-content h2 {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <h1>Animal Quizzes</h1>
  <div class="quiz-container">
    <p class="question">Loading question...</p>
    <div class="options"></div>
    <p class="timer">Time left: <span id="time">15</span> seconds</p>
    <p class="score">Score: <span id="score">0</span></p>
  </div>
  <button id="restart" style="display: none;" onclick="startQuiz()">Restart Quiz</button>

  <script>
const apiUrl = "https://opentdb.com/api.php?amount=10&category=27&difficulty=medium&type=multiple";
let questions = [];
    let currentQuestionIndex = 0;
    let score = 0;
    let consecutiveCorrect = 0;
    let timer;
    const timerDuration = 15;

    async function fetchQuestions() {
      try {
        const response = await fetch(apiUrl);
        const data = await response.json();
        questions = data.results;
        currentQuestionIndex = 0;
        score = 0;
        consecutiveCorrect = 0;
        document.getElementById("score").innerText = score;
        loadQuestion();
      } catch (error) {
        console.error("Error fetching questions:", error);
        document.querySelector(".question").innerText = "Failed to load questions.";
      }
    }

    function loadQuestion() {
      if (currentQuestionIndex >= questions.length) {
        endQuiz();
        return;
      }

      clearInterval(timer);
      const questionData = questions[currentQuestionIndex];
      const questionEl = document.querySelector(".question");
      const optionsEl = document.querySelector(".options");
      const timerEl = document.getElementById("time");

      questionEl.innerHTML = questionData.question;
      optionsEl.innerHTML = "";

      const answers = [...questionData.incorrect_answers, questionData.correct_answer].sort(() => Math.random() - 0.5);
      answers.forEach(answer => {
        const button = document.createElement("button");
        button.innerText = answer;
        button.addEventListener("click", () => checkAnswer(answer, questionData.correct_answer, button));
        optionsEl.appendChild(button);
      });

      startTimer(timerEl);
    }

    function checkAnswer(selected, correct, button) {
      clearInterval(timer);
      const allButtons = document.querySelectorAll(".options button");
      allButtons.forEach(btn => btn.disabled = true);

      if (selected === correct) {
        button.classList.add("correct");
        score += 2;
        consecutiveCorrect++;
        if (consecutiveCorrect > 1) score += 1;
      } else {
        button.classList.add("wrong");
        consecutiveCorrect = 0;
        allButtons.forEach(btn => {
          if (btn.innerText === correct) btn.classList.add("correct");
        });
      }

      document.getElementById("score").innerText = score;
      

      setTimeout(() => {
        currentQuestionIndex++;
        loadQuestion();
      }, 2000);
    }

    function startTimer(timerEl) {
      let timeLeft = timerDuration;
      timerEl.innerText = timeLeft;

      timer = setInterval(() => {
        timeLeft--;
        timerEl.innerText = timeLeft;

        if (timeLeft <= 0) {
          clearInterval(timer);
          alert("Time's up!");
          currentQuestionIndex++;
          loadQuestion();
        }
      }, 1000);
    }

    function endQuiz() {
      document.body.innerHTML = `
        <div class="center-content">
          <h2>Quiz Completed!</h2>
          <h3> Hope you had a blast and learn something new today!</h3>
          <p>Your final score is: <strong>${score}</strong></p>
          <button onclick="startQuiz()">Restart Quiz</button>
        </div>
      `;
    }

    function startQuiz() {
      document.body.innerHTML = `
        <h1>Animal Quizzes</h1>
        <div class="quiz-container">
          <p class="question">Loading question...</p>
          <div class="options"></div>
          <p class="timer">Time left: <span id="time">15</span> seconds</p>
          <p class="score">Score: <span id="score">0</span></p>
        </div>
        <button id="restart" style="display: none;" onclick="startQuiz()">Restart Quiz</button>
      `;
      fetchQuestions();
    }

    fetchQuestions();
  </script>
</body>
</html>
