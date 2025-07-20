// Function to update the streak
function updateStreak() {
    const today = new Date().toDateString();
    const lastVisit = localStorage.getItem('lastVideoDate');
    let streak = parseInt(localStorage.getItem('streak') || 0, 10);

    if (lastVisit) {
        const lastDate = new Date(lastVisit);
        const yesterday = new Date();
        yesterday.setDate(yesterday.getDate() - 1);
        
        // Check if the last visit was yesterday
        if (lastDate.toDateString() === yesterday.toDateString()) {
            streak++;
        } else if (lastDate.toDateString() !== today) {
            // If the last visit was not today or yesterday, reset the streak
            streak = 1;
        }
    } else {
        // If it's the first time, start the streak at 1
        streak = 1;
    }

    localStorage.setItem('lastVideoDate', today);
    localStorage.setItem('streak', streak);

    return streak;
}

// Function to display the streak
function displayStreak() {
    const streak = localStorage.getItem('streak') || 0;
    const streakElement = document.getElementById('streak-counter');
    if (streakElement) {
        streakElement.textContent = `${streak}-Day Streak`;
    }
}

// Function to handle video completion
function videoCompleted() {
    // This function will be called when a video is finished
    // For this example, we'll just log it.
    console.log("Video watched. Updating streak...");
    const newStreak = updateStreak();
    displayStreak();
}

// Check for video elements on the page and attach an event listener
document.addEventListener('DOMContentLoaded', () => {
    displayStreak(); // Display the current streak when the page loads

    // This is a placeholder. You need to link this to a video element's event.
    // For example, if you have a video on your education page:
    const videoElement = document.querySelector('video.dashboard');
    if (videoElement) {
        videoElement.addEventListener('ended', videoCompleted);
        // Alternatively, to simulate "watching" a video without a real video element:
        // You could add a button "I finished watching" that calls `videoCompleted()`
    }
});