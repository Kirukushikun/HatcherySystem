function createPushNotification(type, title, message) {
    // Create notification container
    const notification = document.createElement("div");
    notification.classList.add("push-notification", type);

    // Notification content
    notification.innerHTML = `
        <i class="fa-solid fa-bell ${type}"></i>
        <div class="notification-message">
            <h4>${title}</h4>
            <p>${message}</p>
        </div>
        <i class="fa-solid fa-xmark close-notification" id="close-notification"></i>
    `;

    // Append to body
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.classList.add('active');
    }, 500);

    // Add event listener to close button
    notification.querySelector('.close-notification').addEventListener('click', () => {
        notification.classList.remove('active');
        setTimeout(() => notification.remove(), 500); // Remove the element after animation
    });

    // Automatically hide the notification after 5 seconds
    setTimeout(() => {
        notification.classList.remove('active');
        setTimeout(() => notification.remove(), 500);
    }, 5500);
}

// Get the close icon element
let closeNotification = document.getElementById('close-notification');
// Get the push notification element (assuming it has a class 'push-notification')
let pushNotification = document.querySelector('.push-notification');

if (closeNotification) {
    // Add a click event listener to the close icon
    closeNotification.addEventListener('click', function() {
        // Remove the 'active' class to hide the notification
        if (pushNotification) {
            pushNotification.classList.remove('active');
        }
    });
}

if (pushNotification) {
    // Show the push notification by adding the 'active' class
    setTimeout(() => {
        pushNotification.classList.add('active');
    }, 500);

    // Automatically hide the notification after 5 seconds
    setTimeout(() => {
        pushNotification.classList.remove('active');
    }, 5500);
}