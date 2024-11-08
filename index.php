<!DOCTYPE html>
<html>
<head>
    <title>User Management System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { display: flex; }
        .form-section { width: 300px; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .table-section { flex-grow: 1; margin-left: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f4f4f4; text-align: left; }
        input[type="text"], input[type="password"], textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button { background-color: #4CAF50; color: white; border: none; padding: 10px; cursor: pointer; border-radius: 4px; }
        button:hover { background-color: #45a049; }
        .error { color: red; }
        .success { color: green; }
        .logout { margin-top: 20px; }
    </style>
</head>
<body>

<?php if (!isset($_SESSION['user_id'])): ?>
    <h2>Log In</h2>
    <form action="" method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Log In</button>
        <?php if ($error) { echo "<p class='error'>$error</p>"; } ?>
    </form>

<?php else: ?>
    <div class="container">
        <!-- Form Section -->
        <div class="form-section">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
            <form method="POST">
                <h3>Add User</h3>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="fullname" placeholder="Full Name">
                <textarea name="address" rows="3" placeholder="Address"></textarea>
                <button type="submit" name="save">Save</button>
                <?php if ($success) { echo "<p class='success'>$success</p>"; } ?>
                <?php if ($error) { echo "<p class='error'>$error</p>"; } ?>
            </form>
        </div>

        <!-- Table Section -->
        <div class="table-section">
            <h3>User List</h3>
            <table>
                <tr>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
                <?php while ($user = $users->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['Username']); ?></td>
                    <td><?php echo htmlspecialchars($user['Fullname']); ?></td>
                    <td><?php echo htmlspecialchars($user['Address']); ?></td>
                    <td><?php echo htmlspecialchars($user['DateCreated']); ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" name="remove">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <!-- Logout Button -->
    <form method="POST" class="logout">
        <button type="submit" name="logout">Log Out</button>
    </form>
<?php endif; ?>

</body>
</html>