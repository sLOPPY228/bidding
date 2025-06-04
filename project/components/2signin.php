<?php
require_once "norightclick.php";
?>
<span style="font-family: verdana, geneva, sans-serif;">
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Login form</title>
    <link rel="stylesheet" href="../css/2signin.css">
    <style>
      .feedback-message {
        padding: 15px;
        margin: 10px 0;
        border-radius: 4px;
        display: none;
        text-align: center;
        animation: fadeIn 0.3s ease-out;
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
          transform: translateY(-10px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      .success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
      }

      .error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
      }

      .wrapper button {
        cursor: pointer;
        transition: background-color 0.3s;
      }

      .wrapper button:hover {
        opacity: 0.9;
      }

      .wrapper button:disabled {
        opacity: 0.7;
        cursor: not-allowed;
      }

      .loading {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid #f3f3f3;
        border-radius: 50%;
        border-top: 3px solid #3498db;
        animation: spin 1s linear infinite;
        margin-left: 10px;
        vertical-align: middle;
        display: none;
      }

      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }
    </style>
  </head>

  <body oncontextmenu="return disableRightClick();">
    <nav>
      <a href="galler-E.html">Galler-E</a>
    </nav>

    <div class="wrapper">
      <h1>Sign In</h1>
      <p>Welcome back you've <br> been missed!</p>

      <!-- Feedback message container -->
      <div id="feedbackMessage" class="feedback-message"></div>

      <form id="loginForm" onsubmit="handleLogin(event)">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" id="submitBtn">
          Sign in
          <span class="loading" id="loadingSpinner"></span>
        </button>
      </form>

      <div class="not-member">
        Not a member? <a href="1sign_up.php">Register Now</a>
      </div>
    </div>

    <script>
      function handleLogin(event) {
        event.preventDefault();
        
        const form = event.target;
        const formData = new FormData(form);
        const submitBtn = document.getElementById('submitBtn');
        const loadingSpinner = document.getElementById('loadingSpinner');
        const feedbackDiv = document.getElementById('feedbackMessage');
        
        // Disable the submit button and show loading spinner
        submitBtn.disabled = true;
        loadingSpinner.style.display = 'inline-block';
        feedbackDiv.style.display = 'none';
        
        fetch('2loginLogic.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          feedbackDiv.textContent = data.message;
          feedbackDiv.className = 'feedback-message ' + (data.status === 'success' ? 'success' : 'error');
          feedbackDiv.style.display = 'block';
          
          if (data.status === 'success') {
            // Show success message briefly before redirecting
            setTimeout(() => {
              window.location.href = data.redirect;
            }, 1000);
          } else {
            // Re-enable the submit button and hide loading spinner
            submitBtn.disabled = false;
            loadingSpinner.style.display = 'none';
          }
        })
        .catch(error => {
          feedbackDiv.textContent = 'An error occurred. Please try again.';
          feedbackDiv.className = 'feedback-message error';
          feedbackDiv.style.display = 'block';
          
          // Re-enable the submit button and hide loading spinner
          submitBtn.disabled = false;
          loadingSpinner.style.display = 'none';
        });
      }

      function disableRightClick() {
        return false;
      }
    </script>
  </body>
  </html>
</span>