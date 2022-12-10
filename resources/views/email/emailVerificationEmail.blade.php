<head>
 <style>
.angry-grid {
   width: 30%;
   margin-left:auto;
   margin-right: auto;
   color: #ffffff;
}
  
#item-0 {
   margin:20px;
}
#item-1 {
   text-align: center; 
}
#item-2 { 
margin-top:30px;
}
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
.button {
  text-decoration: none;
  color: #000000;
  background: #ffc107;
  padding: 15px 40px;
  border-radius: 4px;
  font-weight: normal;
  text-transform: uppercase;
  transition: all 0.2s ease-in-out;
  margin-left:auto;
   margin-right: auto;
   margin-top:20px;
}

.glow-button:hover {
  color: rgba(255, 255, 255, 1);
  box-shadow: 0 5px 15px rgba(145, 92, 182, .4);
}
.center-btn {
  margin: 0;
  position: absolute;

  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

</style>

</head>

<body style="background-color:#252525">
    <div class="angry-grid">
		  <div id="item-0">
			<a><img src="https://imageup.me/images/66a0dd63-e6fc-43f2-a9e1-1cc08a8ece0c.png" class="center" width="450" alt=""></a>
		  </div>
		<div id="item-1">
			   <h2 class="m-5">Zweryfikuj swój adres e-mail</h2>
                    Dziękujemy na rejestrację na naszej stronie. Aby zakończyć proces rejestracji aktywuj swoje konto po przed weryfikację adresu e-mail
                    By zweryfikować email kliknij w link poniżej:  </br></br>
		</div>
		<div id="item-2">
			<a href="{{ route('user.verify', $token) }}" class="button glow-button center-btn" target="_blank" role="button">Zweryfikuj E-mail</a>
		</div>
	</div>
               
</body>
