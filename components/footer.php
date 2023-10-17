   <!-- Footer Start -->
   <div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
       <div class="container py-5">
           <div class="row g-5">
               <div class="col-lg-3 col-md-6">
                   <h4 class="text-primary mb-4">Our Office</h4>
                   <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>123 Street, New York, USA</p>
                   <p class="mb-2"><i class="fa fa-phone-alt text-primary me-3"></i>+012 345 67890</p>
                   <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>info@example.com</p>
                   <div class="d-flex pt-3">
                       <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                       <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                       <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-youtube"></i></a>
                       <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-linkedin-in"></i></a>
                   </div>
               </div>
               <div class="col-lg-3 col-md-6">
                   <h4 class="text-primary mb-4">Quick Links</h4>
                   <a class="btn btn-link" href="">About Us</a>
                   <a class="btn btn-link" href="">Contact Us</a>
                   <a class="btn btn-link" href="">Our Services</a>
                   <a class="btn btn-link" href="">Terms & Condition</a>
                   <a class="btn btn-link" href="">Support</a>
               </div>
               <div class="col-lg-3 col-md-6">
                   <h4 class="text-primary mb-4">Business Hours</h4>
                   <p class="mb-1">Monday - Friday</p>
                   <h6 class="text-light">09:00 am - 07:00 pm</h6>
                   <p class="mb-1">Saturday</p>
                   <h6 class="text-light">09:00 am - 12:00 pm</h6>
                   <p class="mb-1">Sunday</p>
                   <h6 class="text-light">Closed</h6>
               </div>
               <div class="col-lg-3 col-md-6">
                   <h4 class="text-primary mb-4">Newsletter</h4>
                   <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                   <div class="position-relative w-100">
                       <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                       <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!-- Footer End -->
   <!-- Back to Top -->
   <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


   <!-- JavaScript Libraries -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
   <script src="assets/lib/wow/wow.min.js"></script>
   <script src="assets/lib/easing/easing.min.js"></script>
   <script src="assets/lib/waypoints/waypoints.min.js"></script>
   <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

   <!-- Template Javascript -->
   <script src="assets/js/main.js"></script>


   <!-- Initialize Swiper -->
   <script>
       var swiper = new Swiper(".mySwiper", {
           effect: "coverflow",
           grabCursor: true,
           centeredSlides: true,
           slidesPerView: "auto",
           coverflowEffect: {
               rotate: 50,
               stretch: 0,
               depth: 100,
               modifier: 1,
               slideShadows: true,
           },
           pagination: {
               el: ".swiper-pagination",
           },
       });
       // AJAX - Upload picture
       function uploadPic() {
           let formData = new FormData();
           formData.append('picture', fileInput.files[0]);

           let xhr = new XMLHttpRequest();
           xhr.open('POST', '../change-img.php');
           xhr.onload = function() {
               if (xhr.status === 200) {
                   console.log(this.responseText);
                   let response = JSON.parse(this.responseText);
                   imageElement.src = '../' + response.url;
               }
           };
           xhr.send(formData);
       }
       let fileInput = document.getElementById('picture-upload');
       let imageElement = document.getElementById('picture-placeholder');
       if (fileInput) {
           fileInput.addEventListener('change', uploadPic);
       }
       //    Add to cart
       let minusBtn = document.getElementsByClassName('minusBtn')
       let plusBtn = document.getElementsByClassName('plusBtn')
       let quantityInput = document.getElementsByClassName('qtyValue')
       let total = document.getElementsByClassName('total')
       let totalCartElement = document.getElementById('totalCart');
       for (let i = 0; i < minusBtn.length; i++) {
           minusBtn[i].addEventListener('click', function() {
               let bookId = minusBtn[i].getAttribute('data-bookid');
               updateQuantity(bookId, 'minus', i);

           })
           plusBtn[i].addEventListener('click', function() {
               let bookId = plusBtn[i].getAttribute('data-bookid');

               updateQuantity(bookId, 'plus', i);
           });
       }

       function updateQuantity(bookId, action, index) {
           let quantity = quantityInput[index].value;

           if (action === 'minus') {
               quantity = parseInt(quantity) - 1;
               if (quantity < 0) {
                   quantity = 0;
               }
           } else if (action === 'plus') {
               quantity = parseInt(quantity) + 1;
           }
           if (quantity === 0) {
               total[index].closest('tr').remove();
               deleteItemFromCart(bookId);
           } else {
               let xhttp = new XMLHttpRequest();
               let data = `bookId=${bookId}&quantity=${quantity}`;
               xhttp.onload = function() {
                   if (this.status == 200) {
                       quantityInput[index].value = quantity;
                       updateTotal(index, quantity);
                       updateTotalCart();
                   } else {
                       console.log("Error updating quantity");
                   }
               };
               xhttp.open("POST", "actions/update_quantity.php", true);
               xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
               xhttp.send(data);
           }
       }

       function updateTotal(index, quantity) {
           let priceStr = total[index].dataset.price;

           let price = parseFloat(priceStr);
           let itemTotal = parseFloat((price * quantity).toFixed(2));
           total[index].innerText = `$ ${itemTotal}`;
       }

       function deleteItemFromCart(bookId) {
           let xhttp = new XMLHttpRequest();
           let data = `bookId=${bookId}`;
           xhttp.onload = function() {
               if (this.status == 200) {
                   console.log("Item removed from the shopping cart");
               } else {
                   console.log("Error removing item from the shopping cart");
               }
           };
           xhttp.open("POST", "actions/delete_item.php", true);
           xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
           xhttp.send(data);
       }

       function updateTotalCart() {
           totalCart = 0;
           for (let i = 0; i < total.length; i++) {
               const itemTotal = parseFloat(total[i].innerText.substring(2));
               totalCart += itemTotal;
           }
           totalCartElement.innerHTML = `TOTAL: $ ${totalCart.toFixed(2)}`;
       }
   </script>
   </body>

   </html>