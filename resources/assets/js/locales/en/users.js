export default {
    'users': 'Users',

    'user_id': 'Id',

    'user_group_id': 'Group',
    'user_group_id_help': 'Users Group',

    'user_name': 'Name',
    'user_name_help': 'Full name.',

    'user_email': 'Email address',
    'user_email_help': 'Valid Email address.',

    'user_password': 'Password',
    'user_password_help': 'At least 8 chars.',

    'create_new_user': 'Create New User',
    'edit_user' : 'Edit User "{name"}',

    'delete_user' : 'Delete User',
    'delete_user_message' : 'Are you sure you want to delete <strong>{name}</strong> ?',

    'mass_delete_user' : 'Delete a list of Users',
    'mass_delete_user_message_template' : 'Are you sure you want to delete this list ?<br /><strong><% _.forEach(rows, function(row) {%><%- row.name %><br /><% }); %></strong>',

    'edit_btn': 'Edit',
    'delete_btn': 'Delete',

    'named_user' : '<strong>{name}</strong> user',
}