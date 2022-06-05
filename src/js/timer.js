const timerCircle = document.querySelector(".timer");
const timerText = document.querySelector(".timer-text");
const timerButton = document.querySelector(".timer-button");
let interval = 0;

const startCounting = (startDate) => {
  timerCircle.style.borderColor = "#00c85b";
  timerButton.innerHTML = "Stop";
  timerButton.style.borderColor = "#E86548";
  timerButton.style.backgroundColor = "#E86548";
  timerButton.setAttribute("counting", 1);
  interval = setInterval(() => {
    startDate = new Date(startDate);
    const difference = new Date(Date.now() - startDate);
    if (difference.getUTCHours() !== 0) {
      timerText.innerHTML = `${difference.getUTCHours()}:${difference.getUTCMinutes()}:${difference.getUTCSeconds()}`;
    } else {
      timerText.innerHTML = `${difference.getUTCMinutes()}:${difference.getUTCSeconds()}`;
    }
  }, 1000);
};

const stopCounting = () => {
  timerCircle.style.borderColor = "gray";
  timerButton.style.borderColor = "#00c85b";
  timerButton.style.backgroundColor = "#00c85b";
  timerText.innerHTML = "";
  timerButton.innerHTML = "Start";
  document.querySelector("#current_task").value = 0;
  timerButton.setAttribute("counting", 0);
  clearInterval(interval);
};

window.addEventListener("load", () => {
  let startDate = Number(document.querySelector("#current_task").value);
  if (startDate !== 0) {
    document.querySelector(".timer-title").innerHTML =
      document.querySelector("#task_name").value;
    startCounting(startDate);
    timerButton.setAttribute("counting", 1);
  }
});
timerButton.addEventListener("click", () => {
  const taskNameElement = document.querySelector("#task_name_input");
  console.log(taskNameElement.value);
  document.querySelector(".timer-title").innerHTML = taskNameElement.value;
  const isCounting = Number(timerButton.getAttribute("counting"));
  if (taskNameElement.value === "" && !isCounting) {
    alert("Podaj nazwe zadania");
    return;
  }
  const formdata = new FormData();
  if (isCounting) {
    stopCounting();
    formdata.append("timer", 0);
  } else {
    let startTime = Math.floor(new Date().getTime());
    startCounting(startTime);
    document.querySelector("#current_task").value = startTime;
    formdata.append("task_name", taskNameElement.value);
    formdata.append("timer", 1);
  }
  fetch("/timer", {
    method: "POST",
    body: formdata,
  });
  taskNameElement.value = "";
});
