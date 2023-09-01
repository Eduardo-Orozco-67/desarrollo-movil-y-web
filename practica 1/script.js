$(document).ready(function() {
    let currentInput = ""; // Variable para almacenar el número actual
    let firstOperand = ""; // Variable para el primer operando
    let operator = ""; // Variable para almacenar el operador

    // Función para mostrar el número actual en la calculadora
    function updateDisplay() {
        $("#result").text(currentInput);
    }

    // Manejar clic en los números
    $(".btn-secondary").click(function() {
        const digit = $(this).text();
        if (digit === "0" && currentInput === "0") {
            return; // Evitar múltiples ceros al inicio
        }
        currentInput += digit;
        updateDisplay();
    });

    // Manejar clic en los operadores
    $(".btn-primary").click(function() {
        if (currentInput !== "") {
            if (firstOperand === "") {
                firstOperand = currentInput;
                operator = $(this).text();
                currentInput = "";
            } else {
                // Realizar cálculos si ya hay un primer operando y operador
                let result;
                const secondOperand = currentInput;
                switch (operator) {
                    case "+":
                        result = parseFloat(firstOperand) + parseFloat(secondOperand);
                        break;
                    case "-":
                        result = parseFloat(firstOperand) - parseFloat(secondOperand);
                        break;
                    case "*":
                        result = parseFloat(firstOperand) * parseFloat(secondOperand);
                        break;
                    case "/":
                        if (parseFloat(secondOperand) === 0) {
                            $("#result").text("Error: División entre 0");
                            return;
                        }
                        result = parseFloat(firstOperand) / parseFloat(secondOperand);
                        break;
                }
                currentInput = result.toString();
                firstOperand = currentInput;
                operator = $(this).text();
                updateDisplay();
            }
        }
    });

    // Manejar clic en el botón "Calcular"
    $(".btn-success").click(function() {
        if (firstOperand !== "" && currentInput !== "") {
            let result;
            const secondOperand = currentInput;
            switch (operator) {
                case "+":
                    result = parseFloat(firstOperand) + parseFloat(secondOperand);
                    break;
                case "-":
                    result = parseFloat(firstOperand) - parseFloat(secondOperand);
                    break;
                case "*":
                    result = parseFloat(firstOperand) * parseFloat(secondOperand);
                    break;
                case "/":
                    if (parseFloat(secondOperand) === 0) {
                        $("#result").text("Error: División entre 0");
                        return;
                    }
                    result = parseFloat(firstOperand) / parseFloat(secondOperand);
                    break;
            }
            currentInput = result.toString();
            firstOperand = "";
            operator = "";
            updateDisplay();
        }
    });

    // Manejar clic en el botón "Reset"
    $("#reset").click(function() {
        currentInput = "";
        firstOperand = "";
        operator = "";
        updateDisplay();
    });
});
