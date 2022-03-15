<!DOCTYPE html>
<header>
    <title>Project 1 - Registration</title>
</header>
<body>
    <forms onsubmit="">
        <label for="username">Username: </label>
        <input type="text" name="username">

        <label for="password">Password: </label>
        <input type="password" name="password">

        <label>Role: </label>

        <input type="radio" id="admin" name="role" value="admin">
        <label for="admin">Admin</label>
        <input type="radio" id="event_manager" name="role" value="event_manager">
        <label for="event_manager">Event Manager</label>
        <input type="radio" id="attendee" name="role" value="attendee">
        <label for="admin">Attendee</label>

        <input type="button" value="Register">
    </form>
</body>
</html>