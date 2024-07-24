const enrollmentNumbers = Array.from({ length: 80 }, (_, i) => 12102040601001 + i);
let currentStudentIndex = 0;

const enrollmentNumberSpan = document.getElementById('enrollmentNumber');
const presentButton = document.getElementById('presentButton');
const absentButton = document.getElementById('absentButton');

// Define the current date in YYYY-MM-DD format
const currentDate = new Date().toISOString().split('T')[0];

function showNextStudent() {
    if (currentStudentIndex < enrollmentNumbers.length) {
        const enrollmentNumber = enrollmentNumbers[currentStudentIndex];
        enrollmentNumberSpan.textContent = ${enrollmentNumber};
        currentStudentIndex++;
    } else {
        enrollmentNumberSpan.textContent = "Attendance Complete";
        presentButton.disabled = true;
        absentButton.disabled = true;
    }
}

function markAttendance(isPresent) {
    // Updated to include the enrollment number in the POST data
    fetch('recordAttendance.php', {
        method: 'POST',
        body: new URLSearchParams({
            'enrollmentNumber': enrollmentNumbers[currentStudentIndex - 1],
            'status': isPresent ? 'p' : 'a'
        }),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Log the server response
        showNextStudent(); // Proceed to the next student
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

// Add event listeners to buttons
presentButton.addEventListener('click', () => markAttendance(true));
absentButton.addEventListener('click', () => markAttendance(false));

// Start the process
showNextStudent();

const previousButton = document.getElementById('previousButton');
const nextButton = document.getElementById('nextButton');

function showPreviousStudent() {
    if (currentStudentIndex > 1) { // Changed from 0 to allow showing the first student again
        currentStudentIndex--;
        const enrollmentNumber = enrollmentNumbers[currentStudentIndex - 1]; // Adjusted index to reflect decrement
        enrollmentNumberSpan.textContent = ${enrollmentNumber};
    }
}

previousButton.addEventListener('click', showPreviousStudent);
nextButton.addEventListener('click', showNextStudent);