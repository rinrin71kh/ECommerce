# Test Cases

---

### TC001: Verify login functionality with valid credentials
- **Preconditions**: User must be registered
- **Steps**:
  1. Go to login page
  2. Enter valid username and password
  3. Click login
- **Test Data**: Email: testuser@example.com, Password: password123
- **Expected**: Redirect to dashboard

---

### TC002: Verify login fails with incorrect password
- **Preconditions**: User must be registered
- **Steps**:
  1. Go to login page
  2. Enter valid email and invalid password
  3. Click login
- **Test Data**: Email: testuser@example.com, Password: wrongpass
- **Expected**: Show error message "Invalid credentials"

---

### TC003: Verify registration with valid data
- **Preconditions**: None
- **Steps**:
  1. Go to registration page
  2. Enter valid name, email, and password
  3. Click register
- **Test Data**: Name: John, Email: john@example.com, Password: password123
- **Expected**: Redirect to dashboard

---

### TC004: Registration fails with existing email
- **Preconditions**: Email already registered
- **Steps**:
  1. Go to registration page
  2. Enter email that already exists
  3. Click register
- **Test Data**: Email: john@example.com
- **Expected**: Show error message "Email already taken"

---

### TC005: Access dashboard without login
- **Preconditions**: User is not logged in
- **Steps**:
  1. Visit /dashboard directly
- **Test Data**: None
- **Expected**: Redirect to login page

---

### TC006: Logout should redirect to login
- **Preconditions**: User is logged in
- **Steps**:
  1. Click on logout button
- **Test Data**: N/A
- **Expected**: Redirect to login page

---

### TC007: Password reset with valid email
- **Preconditions**: Email exists in the system
- **Steps**:
  1. Go to forgot password page
  2. Enter valid email
  3. Click submit
- **Test Data**: Email: john@example.com
- **Expected**: Show message "Reset link sent"

---

### TC008: Password reset with invalid email
- **Preconditions**: Email does not exist
- **Steps**:
  1. Go to forgot password page
  2. Enter invalid email
  3. Click submit
- **Test Data**: Email: fake@example.com
- **Expected**: Show error message "We can't find a user with that email address."

---

### TC009: User profile update with valid data
- **Preconditions**: User is logged in
- **Steps**:
  1. Visit /profile
  2. Update name and/or email
  3. Submit form
- **Test Data**: New Name: Johnny, New Email: johnny@example.com
- **Expected**: Show success message "Profile updated successfully"

---

### TC010: Prevent access to admin panel by normal user
- **Preconditions**: A normal user is logged in
- **Steps**:
  1. Visit /admin
- **Test Data**: N/A
- **Expected**: Show 403 Forbidden page or redirect to home
