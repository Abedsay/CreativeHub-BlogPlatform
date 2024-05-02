document.addEventListener('DOMContentLoaded', function() {
    fetchUsers();
});

function fetchUsers() {
    fetch('fetch_users.php')
    .then(response => response.json())
    .then(users => {
        const container = document.getElementById('userContainer');
        container.innerHTML = ''; 
        users.forEach(user => {
            container.appendChild(createUserCard(user));
        });
    })
    .catch(error => console.error('Error loading users:', error));
}

function createUserCard(user) {
    const div = document.createElement('div');
    div.className = 'user-card';
    div.id = 'user-' + user.user_id;
    div.innerHTML = `<h3>${user.username}</h3>
        <div class="user-info">
            <span>Username:</span> ${user.username}<br>
            <span>Email:</span> ${user.email}<br>
            <span>Post Type:</span> ${user.role === 'admin' ? 'Admin' : 'User'}
        </div>
        <div class="user-actions">
            <button onclick="editUser(${user.user_id})">Edit</button>
            <button onclick="deleteUser(${user.user_id})">Delete</button>
        </div>`;
    return div;
}

function editUser(userId) {
    console.log('Edit User:', userId);
    window.location.href = `edit_user.php?user_id=${userId}`;
}

function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        const formData = new URLSearchParams();
        formData.append('user_id', userId);

        fetch('delete_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log('Delete response:', data);
            if (data.success) {
                alert('User deleted successfully');
                fetchUsers();
            } else {
                alert('Error deleting user: ' + data.error);
            }
        })
        .catch(error => console.error('Error deleting user:', error));
    }
}

document.getElementById('addUserForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new URLSearchParams(new FormData(this));

    fetch('add_user.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Add response:', data);
        if (data.success) {
            alert('User added successfully');
            fetchUsers(); 
        } else {
            alert('Error adding user: ' + data.error);
        }
    })
    .catch(error => console.error('Error adding user:', error));
});
