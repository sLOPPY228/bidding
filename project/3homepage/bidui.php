<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bidding Page</title>
  <link rel="stylesheet" href="bidui.css">
  
 
</head>
<body>

 <!-- navigation bar begin -->
 <nav>
    <div class="logo">
        Galler-E 
     </div>
     <div class="menu">
         <ul>
             <li><a href="homepage.php">Home</a></li>
             <li><a href="#">Categories</a></li>
             <li><a href="../4addproduct/product.php">Products</a></li>
             <li><a href="#"><img src="../pic/pfp.png"></a></li>
         </ul>
     </div>
   </nav>
<!-- nav bar end -->
<hr>
<img class="userimg"  src="pfp.png" />
<hr>

  

<div class="carousel-container" >
  <button onclick="prevSlide()" id="prev-btn" class="prev-btn">
    <svg viewBox="0 0 512 512" width="20" title="chevron-circle-left">
      <path
        d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zM142.1 273l135.5 135.5c9.4 9.4 24.6 9.4 33.9 0l17-17c9.4-9.4 9.4-24.6 0-33.9L226.9 256l101.6-101.6c9.4-9.4 9.4-24.6 0-33.9l-17-17c-9.4-9.4-24.6-9.4-33.9 0L142.1 239c-9.4 9.4-9.4 24.6 0 34z"
      />
    </svg>
  </button>
  <div class="carousel-container">
    <div class="carousel-wrapper" ontransitionend="resetTransition()">
        
        <div class="carousel-item">
            <img src="pfp.png" alt="Image 1">
        </div>
        <div class="carousel-item">
            <img src="project\pic\2.jpg"  alt="Image 2">
        </div>
        <div class="carousel-item">
            <img src="C:\xampp\htdocs\project\pic\3.jpg" alt="Image 3">
        </div>
        <div class="carousel-item">
            <img src="C:\xampp\htdocs\project\pic\4.jpg" alt="Image 4">
        </div>
        <!-- Add more carousel items as needed -->
    </div>
</div>
        <button onclick="nextSlide()" id="next-btn" class="next-btn">
          <svg
            viewBox="0 0 512 512"
            width="20"
            title="chevron-circle-right"
          >
            <path
              d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm113.9 231L234.4 103.5c-9.4-9.4-24.6-9.4-33.9 0l-17 17c-9.4 9.4-9.4 24.6 0 33.9L285.1 256 183.5 357.6c-9.4 9.4-9.4 24.6 0 33.9l17 17c9.4 9.4 24.6 9.4 33.9 0L369.9 273c9.4-9.4 9.4-24.6 0-34z"
            />
          </svg>
        </button> 
    </div>


    



    <div class="container_description" style="border: 2 2 2 2;">
    <h1>user name</h1>
    <h3>product description</h3>
    <p>Minimum Bid Amount: $<span id="current-bid">100</span></p>
    <form id="bid-form">
      <label for="bid-amount">Enter your bid:</label>
      <input type="number" id="bid-amount" name="bid-amount" min="101" required>
      <button type="submit">Place Bid</button>
    </form>
  </div>

  <script>
    // This is just example Javascript, not functional for processing bids
    const bidForm = document.getElementById('bid-form');
    bidForm.addEventListener('submit', (event) => {
      event.preventDefault();
      const newBid = document.getElementById('bid-amount').value;
      console.log(`New bid placed: $${newBid}`);
      // Simulate updating current bid
      document.getElementById('current-bid').textContent = newBid;
    });

    function nextSlide() {
            const wrapper = document.querySelector('.carousel-wrapper');
            const firstItem = wrapper.firstElementChild;
            wrapper.style.transition = 'transform 0.5s ease-in-out';
            wrapper.style.transform = 'translateX(-100%)';
            wrapper.appendChild(firstItem);
        }

        function prevSlide() {
            const wrapper = document.querySelector('.carousel-wrapper');
            const lastItem = wrapper.lastElementChild;
            wrapper.style.transition = 'transform 0.5s ease-in-out';
            wrapper.style.transform = 'translateX(0)';
            wrapper.insertBefore(lastItem, wrapper.firstElementChild);
        }
        // function resetTransition() {
        //     const wrapper = document.querySelector('.carousel-wrapper');
        //     wrapper.style.transition = 'none';
        // }
   
  </script>
    
</body>
</html>