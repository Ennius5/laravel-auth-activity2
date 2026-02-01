<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'My Portfolio')
    </title>
    <style>
/* * {
margin: 0;
padding: 0;
box-sizing: border-box;
} */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    background-image: url('images/Dark-Woods-HD-Photo.jpg'); /* Add your image path */
    background-size: cover; /* Makes image cover the entire screen */
    background-position: center; /* Centers the image */
    background-repeat: no-repeat; /* Prevents repeating */
    background-attachment: fixed; /* Makes it stay in place when scrolling */
    min-height: 100vh; /* Ensures it covers full viewport height */
}
nav {
background: #362A17A1;
color: white;
padding: 1rem 2rem;
}
nav ul {
list-style: none;
display: flex;
gap: 2rem;
}
nav a {
color: white;
text-decoration: none;
font-weight: bold;
}
nav a:hover {
color: #3498db;
}

.container {
max-width: 1200px;
margin: 2rem auto;
padding: 2rem;
background: #BABABA85;
border-radius: 8px;
box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
h1 {
color: #333;
margin-bottom: 1rem;
}
footer {
  position: sticky;
  flex-shrink: 0;
  text-align: center;
  padding: 20px;
  background: #362A17A1;
  color: white;
  margin-top: 2rem;
}

.social-links {
  margin-top: 10px;
}

.social-links a {
  margin: 0 10px;
  color: #C0B16E;
  text-decoration: none;
}

.social-links a:hover {
  color: #FF0055;
  text-decoration: solid;
}
</style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<nav>

</nav>
<div class="container">
@yield('content')

</div>
<footer>
  <p>&copy; {{ date('Y') }} All rights are opposites of lefts. All lefts my rights have reserved.</p>

  <div class="social-links">
    <a href="https://github.com/Ennius5" target="_blank" rel="noopener noreferrer">GitHub</a>
    <a href="https://linkedin.com/in/Ennius5" target="_blank" rel="noopener noreferrer">LinkedIn</a>
    <a href="https://twitter.com/Ennius5" target="_blank" rel="noopener noreferrer">Twitter</a>
    <a href="https://instagram.com/Ennius5" target="_blank" rel="noopener noreferrer">Instagram</a>
    <a href="mailto:e.campomanes101848@gmail.com">Email</a>
  </div>
</footer>
</body>
</html>
