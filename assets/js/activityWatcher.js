function activityWatcher() {
    var secondsSinceLastActivity = 0;
    var maxInactivity = 900; // 15 minutes in seconds (60 seconds * 15 minutes)
  
    function resetTimer() {
      secondsSinceLastActivity = 0;
    }
  
    function checkInactivity() {
      secondsSinceLastActivity++;
      console.log(secondsSinceLastActivity + ' seconds since the user was last active');
  
      if (secondsSinceLastActivity > maxInactivity) {
        console.log('User has been inactive for more than ' + maxInactivity + ' seconds');
        // Redirect to log_out page or perform logout action
        location.href = 'log_out.php';
      }
    }
  
    function updateActivity() {
    
      $.ajax({
        url: 'get_user_status.php',
        method: 'POST',
        dataType: 'json', 
        success: function (response) {
          console.log('User activity updated successfully');
        },
        error: function (xhr, status, error) {
          console.error('Error updating user activity: ' + error);
        },
      });
    }
  
    var activityEvents = [
      'mousedown', 'mousemove', 'keydown',
      'scroll', 'touchstart'
    ];
  
    activityEvents.forEach(function (eventName) {
      document.addEventListener(eventName, function () {
        resetTimer();
        updateActivity(); // Update activity when user interacts
      }, true);
    });
  
    setInterval(checkInactivity, 1000); // Check inactivity every second
  }
  
  activityWatcher();
  /*function checkOnlineStatus() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = xhr.responseText;
      if (response === 'online') {
        console.log('User is online');
      } else {
        console.log('User is offline');
      }
    }
  };
  xhr.open('GET', 'get_user_status.php', true);
  xhr.send();
}

setInterval(checkOnlineStatus, 5000); // Check every 5 seconds
*/