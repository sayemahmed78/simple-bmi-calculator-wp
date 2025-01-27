document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById('bmi-calculate-button');
    if (button) {
        button.addEventListener('click', function () {
            const height = parseFloat(document.getElementById('height').value) / 100;
            const weight = parseFloat(document.getElementById('weight').value);
            const bmi = weight / (height * height);
            let category = '';

            if (bmi < 18.5) category = 'Underweight';
            else if (bmi < 24.9) category = 'Normal weight';
            else if (bmi < 29.9) category = 'Overweight';
            else category = 'Obesity';

            document.getElementById('bmi-result').innerText = `Your BMI: ${bmi.toFixed(2)} (${category})`;
        });
    }
});
