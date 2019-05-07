<div class="search-container">
    <p class="greeting-message">What would you like to cook?</p>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self" id="search-form">
        <input type="text" name="query" id="query" autofocus>
        <input type="submit" id="submit">
    </form>
</div>