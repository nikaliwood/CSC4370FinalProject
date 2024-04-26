<?php
// Start the session
session_start();

// Unset specific session variables (like user-specific data)
unset($_SESSION['logged_in']);
unset($_SESSION['name']); // Or any other user-related session variable

// Optionally destroy the entire session (for complete session invalidation)
session_destroy();

// Redirect the user to a specific page (like the home page or login page)
header("Location: index.php"); // Change to your desired redirect location
exit(); // Always exit after a header redirect to avoid further script execution
?>
