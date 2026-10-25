<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Admin Panel Muscle Core Gym</title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
      <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
      <script>
        function showForm(section) {
            document.querySelectorAll('.form-container').forEach(form => form.style.display = 'none');
            const formElement = document.getElementById(section);
            if (formElement) {
                formElement.style.display = 'block';
            }
            document.querySelectorAll('.sidebar li').forEach(li => {
                li.classList.toggle('active', li.getAttribute('data-section') === section);
            });
        }

        function toast(message, type) {
            var wrap = document.getElementById('toast-wrap');
            if (!wrap) {
                wrap = document.createElement('div');
                wrap.id = 'toast-wrap';
                document.body.appendChild(wrap);
            }
            var text = (message === undefined || message === null || message === '')
                ? 'Something went wrong. Please try again.'
                : String(message);
            if (!type) {
                if (/^no /i.test(text)) type = 'info';
                else if (/error|fail|incorrect|invalid|unknown|denied|pending|unauthori|occurred|unable|missing|unauthorized/i.test(text)) type = 'error';
                else if (/success|added|updated|deleted|approved|found|logged/i.test(text)) type = 'success';
                else type = 'info';
            }
            var el = document.createElement('div');
            el.className = 'admin-toast ' + type;
            el.textContent = text;
            wrap.appendChild(el);
            setTimeout(function () { el.classList.add('show'); }, 20);
            setTimeout(function () {
                el.classList.remove('show');
                setTimeout(function () { if (el.parentNode) el.remove(); }, 450);
            }, 4200);
        }
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
 </head>
 <body>
      <nav class="navbar navbar-expand-md shadow-sm">
          <div class="container">
              <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                  <img src="{{ asset('images/mcg.jpg') }}" alt="Muscle Core Gym logo">
                  Muscle Core <span class="brand-sub">Admin</span>
              </a>
              <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-user-circle me-1"></i> {{ Auth::guard('admin')->user()->name ?? 'Guest' }}
                  </button>
                  <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                  </ul>
                 <a href="{{ route('admin.pendingUsers') }}" class="pending-btn"><i class="fas fa-user-clock"></i> Pending Approvals</a>

              </div>

          </div>
      </nav>

      <div class="sidebar">
          <h2>Admin Panel</h2>
          <ul>
              <li data-section="customer-form" onclick="showForm('customer-form')"><i class="fas fa-users"></i><span>Manage Customers</span></li>
              <li data-section="trainer-form" onclick="showForm('trainer-form')"><i class="fas fa-user-tie"></i><span>Manage Trainers</span></li>
              <li data-section="equipment-form" onclick="showForm('equipment-form')"><i class="fas fa-dumbbell"></i><span>Manage Equipment</span></li>
              <li data-section="feedback-form" onclick="showForm('feedback-form')"><i class="fas fa-comment-dots"></i><span>Manage Feedback</span></li>
              <li data-section="class-form" onclick="showForm('class-form')"><i class="fas fa-calendar-check"></i><span>Manage Classes</span></li>
              <li data-section="schedule-form" onclick="showForm('schedule-form')"><i class="fas fa-clock"></i><span>Manage Schedules</span></li>
              <li data-section="subscription-form" onclick="showForm('subscription-form')"><i class="fas fa-id-card"></i><span>Manage Subscription Plans</span></li>
              <li data-section="payment-form" onclick="showForm('payment-form')"><i class="fas fa-money-bill-wave"></i><span>Manage Payments</span></li>

          </ul>
      </div>

      <div class="main-content">
          <div class="card">
              <div class="card-header">
                  <h3 class="h5">Dashboard</h3>
              </div>
              <div class="card-body">
                  <p class="mb-1">Welcome back, <strong style="color:var(--gold-bright)">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</strong>. You are logged in pick a section from the sidebar to start managing the gym.</p>
                  <div class="welcome-actions">
                      <a href="{{ route('admin.subscriptions') }}" class="pending-btn"><i class="fas fa-chart-line"></i> See Monthly Records</a>
                  </div>
              </div>
          </div>



          <!-- Customer Form -->
          <div id="customer-form" class="form-container">
              <h3>Manage Customers</h3>
              <div class="button-group">
                  <button id="add-customer-btn" class="btn btn-success btn-custom">
                      <i class="fas fa-plus"></i> Add
                  </button>
                  <button id="delete-customer-btn" class="btn btn-danger btn-custom">
                      <i class="fas fa-trash"></i> Delete
                  </button>
                  <button id="edit-customer-btn" class="btn btn-warning btn-custom">
                      <i class="fas fa-edit"></i> Edit
                  </button>
                  <button id="view-customer-btn" class="btn btn-info btn-custom">
                      <i class="fas fa-eye"></i> View
                  </button>
                  <button id="update-customer-btn" class="btn btn-primary btn-custom">
                      <i class="fas fa-sync"></i> Update
                  </button>
                  <button id="view-all-customers-btn" class="btn btn-secondary btn-custom">
                      <i class="fas fa-list"></i> View All
                  </button>
              </div>

              <div id="add-customer-form" style="display: none; margin-top: 15px;">
                  <h4>Add Customer</h4>
                  <form id="customer-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="customer-name" class="form-label">Name:</label>
                          <input type="text" id="customer-name" name="name" class="form-control">
                      </div>
                      <div class="mb-2">
                          <label for="customer-email" class="form-label">Email:</label>
                          <input type="email" id="customer-email" name="email" class="form-control">
                      </div>
                      <div class="mb-2">
                          <label for="role" class="form-label">Role:</label>
                          <input type="text" id="role" name="role" class="form-control">
                      </div>
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-secondary" id="cancel-btn-customer">Cancel</button>
                  </form>
              </div>

              <div id="edit-customer-form" style="display: none; margin-top: 15px;">
                  <h4>Edit Customer</h4>
                  <form id="edit-customer-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="edit-customer-email" class="form-label">Email of Customer to Edit:</label>
                          <input type="email" id="edit-customer-email" name="email" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="edit-customer-name" class="form-label">New Name:</label>
                          <input type="text" id="edit-customer-name" name="name" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="edit-customer-role" class="form-label">New Role:</label>
                          <input type="text" id="edit-customer-role" name="role" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                      <button type="button" class="btn btn-secondary" id="cancel-edit-btn">Cancel</button>
                  </form>
              </div>

              <div id="delete-customer-form" style="display: none; margin-top: 15px;">
                  <h4>Delete Customer</h4>
                  <form id="delete-customer-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="delete-customer-email" class="form-label">Email of Customer to Delete:</label>
                          <input type="email" id="delete-customer-email" name="email" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-danger">Delete</button>
                      <button type="button" class="btn btn-secondary" id="cancel-delete-btn">Cancel</button>
                  </form>
              </div>

              <div id="view-customer-form" style="display: none; margin-top: 15px;">
                  <h4>View Customer</h4>
                  <form id="view-customer-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="view-customer-email" class="form-label">Email of Customer to View:</label>
                          <input type="email" id="view-customer-email" name="email" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-info">View</button>
                      <button type="button" class="btn btn-secondary" id="cancel-view-btn">Cancel</button>
                  </form>
                  <div id="customer-info" class="mt-3" style="display: none;">
                      <h5>Customer Details:</h5>
                      <p><strong>Name:</strong> <span id="view-customer-name"></span></p>
                      <p><strong>Email:</strong> <span id="view-customer-email-display"></span></p>
                      <p><strong>Role:</strong> <span id="view-customer-role"></span></p>
                      <p><strong>Created At:</strong> <span id="view-customer-created"></span></p>
                  </div>
              </div>

              <div id="update-customer-form" style="display: none; margin-top: 15px;">
                  <h4>Update Customer</h4>
                  <form id="update-customer-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="update-customer-email" class="form-label">Email of Customer to Update:</label>
                          <input type="email" id="update-customer-email" name="email" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="update-customer-name" class="form-label">New Name:</label>
                          <input type="text" id="update-customer-name" name="name" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="update-customer-role" class="form-label">New Role:</label>
                          <input type="text" id="update-customer-role" name="role" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Update</button>
                      <button type="button" class="btn btn-secondary" id="cancel-update-btn">Cancel</button>
                  </form>
              </div>

              <div id="view-all-customers" style="display: none; margin-top: 15px;">
                  <h4>All Customers</h4>
                  <div id="customers-list" class="mt-3">
                      <!-- Customer list will be populated here -->
                  </div>
                  <button type="button" class="btn btn-secondary mt-2" id="close-view-all-btn">Close</button>
              </div>
          </div>

          <!-- Trainer Form -->
          <div id="trainer-form" class="form-container">
              <h3>Manage Trainers</h3>
              <div class="button-group">
                  <button id="add-trainer-btn" class="btn btn-success btn-custom">
                      <i class="fas fa-plus"></i> Add
                  </button>
                  <button id="edit-trainer-btn" class="btn btn-warning btn-custom">
                      <i class="fas fa-edit"></i> Edit
                  </button>
                  <button id="delete-trainer-btn" class="btn btn-danger btn-custom">
                      <i class="fas fa-trash"></i> Delete
                  </button>
                  <button id="view-trainer-btn" class="btn btn-info btn-custom">
                      <i class="fas fa-eye"></i> View
                  </button>
                  <button id="update-trainer-btn" class="btn btn-primary btn-custom">
                      <i class="fas fa-sync"></i> Update
                  </button>
                  <button id="search-trainer-btn" class="btn btn-secondary btn-custom">
                      <i class="fas fa-search"></i> Search
                  </button>
              </div>

              <div id="add-trainer-form" style="display: none; margin-top: 15px;">
                  <h4>Add Trainer</h4>
                  <form id="trainer-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="trainer-name" class="form-label">Name:</label>
                          <input type="text" id="trainer-name" name="name" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="trainer-email" class="form-label">Email:</label>
                          <input type="email" id="trainer-email" name="email" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-secondary" id="cancel-add-trainer-btn">Cancel</button>
                  </form>
              </div>

              <div id="edit-trainer-form" style="display: none; margin-top: 15px;">
                  <h4>Edit Trainer</h4>
                  <form id="edit-trainer-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="edit-trainer-email" class="form-label">Email of Trainer to Edit:</label>
                          <input type="email" id="edit-trainer-email" name="email" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="edit-trainer-name" class="form-label">New Name:</label>
                          <input type="text" id="edit-trainer-name" name="name" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                      <button type="button" class="btn btn-secondary" id="cancel-edit-trainer-btn">Cancel</button>
                  </form>
              </div>

              <div id="delete-trainer-form" style="display: none; margin-top: 15px;">
                  <h4>Delete Trainer</h4>
                  <form id="delete-trainer-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="delete-trainer-email" class="form-label">Email of Trainer to Delete:</label>
                          <input type="email" id="delete-trainer-email" name="email" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-danger">Delete</button>
                      <button type="button" class="btn btn-secondary" id="cancel-delete-trainer-btn">Cancel</button>
                  </form>
              </div>

              <div id="view-trainer-form" style="display: none; margin-top: 15px;">
                  <h4>View Trainer</h4>
                  <form id="view-trainer-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="view-trainer-email" class="form-label">Email of Trainer to View:</label>
                          <input type="email" id="view-trainer-email" name="email" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-info">View</button>
                      <button type="button" class="btn btn-secondary" id="cancel-view-trainer-btn">Cancel</button>
                  </form>
                  <div id="trainer-info" class="mt-3" style="display: none;">
                      <h5>Trainer Details:</h5>
                      <p><strong>Name:</strong> <span id="view-trainer-name"></span></p>
                      <p><strong>Email:</strong> <span id="view-trainer-email-display"></span></p>
                      <p><strong>Role:</strong> <span id="view-trainer-role"></span></p>
                      <p><strong>Created At:</strong> <span id="view-trainer-created"></span></p>
                  </div>
              </div>

              <div id="update-trainer-form" style="display: none; margin-top: 15px;">
                  <h4>Update Trainer</h4>
                  <form id="update-trainer-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="update-trainer-email" class="form-label">Email of Trainer to Update:</label>
                          <input type="email" id="update-trainer-email" name="email" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="update-trainer-name" class="form-label">New Name:</label>
                          <input type="text" id="update-trainer-name" name="name" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Update</button>
                      <button type="button" class="btn btn-secondary" id="cancel-update-trainer-btn">Cancel</button>
                  </form>
              </div>

              <div id="search-trainer-form" style="display: none; margin-top: 15px;">
                  <h4>Search Trainer</h4>
                  <form id="search-trainer-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="search-trainer-email" class="form-label">Email of Trainer to Search:</label>
                          <input type="email" id="search-trainer-email" name="email" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-secondary">Search</button>
                      <button type="button" class="btn btn-secondary" id="cancel-search-trainer-btn">Cancel</button>
                  </form>
                  <div id="search-trainer-results" class="mt-3" style="display: none;">
                      <h5>Search Results:</h5>
                      <div id="trainer-search-list"></div>
                  </div>
              </div>
          </div>

          <!-- Equipment Form -->
          <div id="equipment-form" class="form-container">
              <h3>Manage Equipment</h3>
              <div class="button-group">
                  <button id="add-equipment-btn" class="btn btn-success btn-custom">
                      <i class="fas fa-plus"></i> Add
                  </button>
                  <button id="edit-equipment-btn" class="btn btn-warning btn-custom">
                      <i class="fas fa-edit"></i> Edit
                  </button>
                  <button id="delete-equipment-btn" class="btn btn-danger btn-custom">
                      <i class="fas fa-trash"></i> Delete
                  </button>
                  <button id="view-equipment-btn" class="btn btn-info btn-custom">
                      <i class="fas fa-eye"></i> View
                  </button>
                  <button id="update-equipment-btn" class="btn btn-primary btn-custom">
                      <i class="fas fa-sync"></i> Update
                  </button>
                  <button id="search-equipment-btn" class="btn btn-secondary btn-custom">
                      <i class="fas fa-search"></i> Search
                  </button>
              </div>

              <div id="add-equipment-form" style="display: none; margin-top: 15px;">
                  <h4>Add Equipment</h4>
                  <form id="equipment-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="equipment-name" class="form-label">Name:</label>
                          <input type="text" id="equipment-name" name="name" class="form-control">
                      </div>
                      <div class="mb-2">
                          <label for="quantity" class="form-label">Quantity:</label>
                          <input type="number" id="quantity" name="quantity" class="form-control" min="1" required>
                      </div>
                      <div class="mb-2">
                          <label for="maintenance_day" class="form-label">Maintenance Date:</label>
                          <input type="date" id="maintenance_day" name="maintenance_day" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-secondary" id="cancel-btn-equipment">Cancel</button>
                  </form>
              </div>

              <div id="edit-equipment-form" style="display: none; margin-top: 15px;">
                  <h4>Edit Equipment</h4>
                  <form id="edit-equipment-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="edit-equipment-name" class="form-label">Equipment Name to Edit:</label>
                          <input type="text" id="edit-equipment-name" name="name" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="edit-equipment-quantity" class="form-label">New Quantity:</label>
                          <input type="number" id="edit-equipment-quantity" name="quantity" class="form-control" min="1" required>
                      </div>
                      <div class="mb-2">
                          <label for="edit-maintenance-day" class="form-label">New Maintenance Date:</label>
                          <input type="date" id="edit-maintenance-day" name="maintenance_day" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                      <button type="button" class="btn btn-secondary" id="cancel-edit-equipment-btn">Cancel</button>
                  </form>
              </div>

              <div id="delete-equipment-form" style="display: none; margin-top: 15px;">
                  <h4>Delete Equipment</h4>
                  <form id="delete-equipment-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="delete-equipment-name" class="form-label">Equipment Name to Delete:</label>
                          <input type="text" id="delete-equipment-name" name="name" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-danger">Delete</button>
                      <button type="button" class="btn btn-secondary" id="cancel-delete-equipment-btn">Cancel</button>
                  </form>
              </div>

              <div id="view-equipment-form" style="display: none; margin-top: 15px;">
                  <h4>View Equipment</h4>
                  <form id="view-equipment-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="view-equipment-name" class="form-label">Equipment Name to View:</label>
                          <input type="text" id="view-equipment-name" name="name" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-info">View</button>
                      <button type="button" class="btn btn-secondary" id="cancel-view-equipment-btn">Cancel</button>
                  </form>
                  <div id="equipment-info" class="mt-3" style="display: none;">
                      <h5>Equipment Details:</h5>
                      <p><strong>Name:</strong> <span id="view-equipment-name-display"></span></p>
                      <p><strong>Quantity:</strong> <span id="view-equipment-quantity"></span></p>
                      <p><strong>Maintenance Date:</strong> <span id="view-equipment-maintenance"></span></p>
                      <p><strong>Created At:</strong> <span id="view-equipment-created"></span></p>
                  </div>
              </div>

              <div id="update-equipment-form" style="display: none; margin-top: 15px;">
                  <h4>Update Equipment</h4>
                  <form id="update-equipment-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="update-equipment-name" class="form-label">Equipment Name to Update:</label>
                          <input type="text" id="update-equipment-name" name="name" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="update-equipment-quantity" class="form-label">New Quantity:</label>
                          <input type="number" id="update-equipment-quantity" name="quantity" class="form-control" min="1" required>
                      </div>
                      <div class="mb-2">
                          <label for="update-maintenance-day" class="form-label">New Maintenance Date:</label>
                          <input type="date" id="update-maintenance-day" name="maintenance_day" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Update</button>
                      <button type="button" class="btn btn-secondary" id="cancel-update-equipment-btn">Cancel</button>
                  </form>
              </div>

              <div id="search-equipment-form" style="display: none; margin-top: 15px;">
                  <h4>Search Equipment</h4>
                  <form id="search-equipment-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="search-equipment-name" class="form-label">Equipment Name to Search:</label>
                          <input type="text" id="search-equipment-name" name="name" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-secondary">Search</button>
                      <button type="button" class="btn btn-secondary" id="cancel-search-equipment-btn">Cancel</button>
                  </form>
                  <div id="search-equipment-results" class="mt-3" style="display: none;">
                      <h5>Search Results:</h5>
                      <div id="equipment-search-list"></div>
                  </div>
              </div>
          </div>

          <!-- Feedback Form -->
          <div id="feedback-form" class="form-container">
              <h3>Manage Feedback</h3>
              <div class="button-group">
                  <button id="add-feedback-btn" class="btn btn-success btn-custom">
                      <i class="fas fa-plus"></i> Add
                  </button>
                  <button id="edit-feedback-btn" class="btn btn-warning btn-custom">
                      <i class="fas fa-edit"></i> Edit
                  </button>
                  <button id="delete-feedback-btn" class="btn btn-danger btn-custom">
                      <i class="fas fa-trash"></i> Delete
                  </button>
                  <button id="view-feedback-btn" class="btn btn-info btn-custom">
                      <i class="fas fa-eye"></i> View All
                  </button>
                  <button id="update-feedback-btn" class="btn btn-primary btn-custom">
                      <i class="fas fa-sync"></i> Update
                  </button>
                  <button id="search-feedback-btn" class="btn btn-secondary btn-custom">
                      <i class="fas fa-search"></i> Search
                  </button>
              </div>

              <div id="add-feedback-form" style="display: none; margin-top: 15px;">
                  <h4>Add Feedback</h4>
                  <form id="add-feedback-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="add-feedback-user-id" class="form-label">User ID:</label>
                          <input type="number" id="add-feedback-user-id" name="user_id" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="add-feedback-text" class="form-label">Feedback Text:</label>
                          <textarea id="add-feedback-text" name="feedback_text" class="form-control" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-secondary" id="cancel-add-feedback-btn">Cancel</button>
                  </form>
              </div>

              <div id="edit-feedback-form" style="display: none; margin-top: 15px;">
                  <h4>Edit Feedback</h4>
                  <form id="edit-feedback-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="edit-feedback-id" class="form-label">Feedback ID to Edit:</label>
                          <input type="number" id="edit-feedback-id" name="feedback_id" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="edit-feedback-text" class="form-label">New Feedback Text:</label>
                          <textarea id="edit-feedback-text" name="feedback_text" class="form-control" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                      <button type="button" class="btn btn-secondary" id="cancel-edit-feedback-btn">Cancel</button>
                  </form>
              </div>

              <div id="delete-feedback-form" style="display: none; margin-top: 15px;">
                  <h4>Delete Feedback</h4>
                  <form id="delete-feedback-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="delete-feedback-id" class="form-label">Feedback ID to Delete:</label>
                          <input type="number" id="delete-feedback-id" name="feedback_id" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-danger">Delete</button>
                      <button type="button" class="btn btn-secondary" id="cancel-delete-feedback-btn">Cancel</button>
                  </form>
              </div>

              <div id="view-all-feedback" style="display: none; margin-top: 15px;">
                  <h4>All Feedback</h4>
                  <div id="feedback-list" class="mt-3">
                      <!-- Feedback list will be populated here -->
                  </div>
                  <button type="button" class="btn btn-secondary mt-2" id="close-view-all-feedback-btn">Close</button>
              </div>

              <div id="update-feedback-form" style="display: none; margin-top: 15px;">
                  <h4>Update Feedback</h4>
                  <form id="update-feedback-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="update-feedback-id" class="form-label">Feedback ID to Update:</label>
                          <input type="number" id="update-feedback-id" name="feedback_id" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="update-feedback-text" class="form-label">New Feedback Text:</label>
                          <textarea id="update-feedback-text" name="feedback_text" class="form-control" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Update</button>
                      <button type="button" class="btn btn-secondary" id="cancel-update-feedback-btn">Cancel</button>
                  </form>
              </div>

              <div id="search-feedback-form" style="display: none; margin-top: 15px;">
                  <h4>Search Feedback</h4>
                  <form id="search-feedback-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="search-feedback-id" class="form-label">Feedback ID to Search:</label>
                          <input type="number" id="search-feedback-id" name="feedback_id" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-secondary">Search</button>
                      <button type="button" class="btn btn-secondary" id="cancel-search-feedback-btn">Cancel</button>
                  </form>
                  <div id="search-feedback-results" class="mt-3" style="display: none;">
                      <h5>Search Results:</h5>
                      <div id="feedback-search-list"></div>
                  </div>
              </div>
          </div>

          <!-- Class Form -->
          <div id="class-form" class="form-container">
              <h3>Manage Classes</h3>
              <div class="button-group">
                  <button id="add-class-btn" class="btn btn-success btn-custom">
                      <i class="fas fa-plus"></i> Add
                  </button>
                  <button id="edit-class-btn" class="btn btn-warning btn-custom">
                      <i class="fas fa-edit"></i> Edit
                  </button>
                  <button id="delete-class-btn" class="btn btn-danger btn-custom">
                      <i class="fas fa-trash"></i> Delete
                  </button>
                  <button id="view-class-btn" class="btn btn-info btn-custom">
                      <i class="fas fa-eye"></i> View All
                  </button>
                  <button id="update-class-btn" class="btn btn-primary btn-custom">
                      <i class="fas fa-sync"></i> Update
                  </button>
                  <button id="search-class-btn" class="btn btn-secondary btn-custom">
                      <i class="fas fa-search"></i> Search
                  </button>
              </div>

              <div id="add-class-form" style="display: none; margin-top: 15px;">
                  <h4>Add Class</h4>
                  <form id="class-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="class-name" class="form-label">Class Name:</label>
                          <input type="text" id="class-name" name="class_name" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="max-capacity" class="form-label">Max Capacity:</label>
                          <input type="number" id="max-capacity" name="max_capacity" class="form-control" min="1" required>
                      </div>
                      <div class="mb-2">
                          <label for="trainer-id" class="form-label">Trainer:</label>
                          <select id="trainer-id" name="T_id" class="form-control" required>
                              <option value="">Select Trainer</option>
                              @foreach(App\Models\User::where('role', 'trainer')->get() as $trainer)
                                  <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                              @endforeach
                          </select>
                      </div>
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-secondary" id="cancel-btn-class">Cancel</button>
                  </form>
              </div>

              <div id="edit-class-form" style="display: none; margin-top: 15px;">
                  <h4>Edit Class</h4>
                  <form id="edit-class-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="edit-class-id" class="form-label">Select Class:</label>
                          <select id="edit-class-id" name="C_id" class="form-control" required>
                              <option value="">Select Class to Edit</option>
                              @foreach(App\Models\ClassModel::all() as $class)
                                  <option value="{{ $class->C_id }}">{{ $class->class_name }}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="mb-2">
                          <label for="edit-class-name" class="form-label">Class Name:</label>
                          <input type="text" id="edit-class-name" name="class_name" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="edit-max-capacity" class="form-label">Max Capacity:</label>
                          <input type="number" id="edit-max-capacity" name="max_capacity" class="form-control" min="1" required>
                      </div>
                      <div class="mb-2">
                          <label for="edit-trainer-id" class="form-label">Trainer:</label>
                          <select id="edit-trainer-id" name="T_id" class="form-control" required>
                              <option value="">Select Trainer</option>
                              @foreach(App\Models\User::where('role', 'trainer')->get() as $trainer)
                                  <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                              @endforeach
                          </select>
                      </div>
                      <button type="submit" class="btn btn-warning">Update</button>
                      <button type="button" class="btn btn-secondary" id="edit-cancel-btn">Cancel</button>
                  </form>
              </div>

              <div id="delete-class-form" style="display: none; margin-top: 15px;">
                  <h4>Delete Class</h4>
                  <form id="delete-class-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="delete-class-id" class="form-label">Select Class to Delete:</label>
                          <select id="delete-class-id" name="C_id" class="form-control" required>
                              <option value="">Select Class</option>
                              @foreach(App\Models\ClassModel::all() as $class)
                                  <option value="{{ $class->C_id }}">{{ $class->class_name }}</option>
                              @endforeach
                          </select>
                      </div>
                      <button type="submit" class="btn btn-danger">Delete</button>
                      <button type="button" class="btn btn-secondary" id="delete-cancel-btn">Cancel</button>
                  </form>
              </div>

              <div id="view-class-form" style="display: none; margin-top: 15px;">
                  <h4>All Classes</h4>
                  <div id="class-list" class="mb-2">
                      <!-- Classes will be populated via JavaScript -->
                  </div>
                  <button type="button" class="btn btn-secondary" id="view-cancel-btn">Close</button>
              </div>

              <div id="update-class-form" style="display: none; margin-top: 15px;">
                  <h4>Update Class</h4>
                  <form id="update-class-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="update-class-id" class="form-label">Select Class:</label>
                          <select id="update-class-id" name="C_id" class="form-control" required>
                              <option value="">Select Class to Update</option>
                              @foreach(App\Models\ClassModel::all() as $class)
                                  <option value="{{ $class->C_id }}">{{ $class->class_name }}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="mb-2">
                          <label for="update-class-name" class="form-label">Class Name:</label>
                          <input type="text" id="update-class-name" name="class_name" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="update-max-capacity" class="form-label">Max Capacity:</label>
                          <input type="number" id="update-max-capacity" name="max_capacity" class="form-control" min="1" required>
                      </div>
                      <div class="mb-2">
                          <label for="update-trainer-id" class="form-label">Trainer:</label>
                          <select id="update-trainer-id" name="T_id" class="form-control" required>
                              <option value="">Select Trainer</option>
                              @foreach(App\Models\User::where('role', 'trainer')->get() as $trainer)
                                  <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                              @endforeach
                          </select>
                      </div>
                      <button type="submit" class="btn btn-primary">Update</button>
                      <button type="button" class="btn btn-secondary" id="update-cancel-btn">Cancel</button>
                  </form>
              </div>

              <div id="search-class-form" style="display: none; margin-top: 15px;">
                  <h4>Search Classes</h4>
                  <form id="search-class-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="search-class-name" class="form-label">Class Name:</label>
                          <input type="text" id="search-class-name" name="class_name" class="form-control">
                      </div>
                      <button type="submit" class="btn btn-secondary">Search</button>
                      <button type="button" class="btn btn-secondary" id="search-cancel-btn">Cancel</button>
                  </form>
                  <div id="search-results" class="mt-2">
                      <!-- Search results will be populated via JavaScript -->
                  </div>
              </div>
          </div>

          <!-- Schedule Form -->
          <div id="schedule-form" class="form-container">
              <h3>Manage Schedules</h3>
              <div class="button-group">
                  <button id="add-schedule-btn" class="btn btn-success btn-custom">
                      <i class="fas fa-plus"></i> Add
                  </button>
                  <button id="delete-schedule-btn" class="btn btn-danger btn-custom">
                      <i class="fas fa-trash"></i> Delete
                  </button>
                  <button id="view-schedule-btn" class="btn btn-info btn-custom">
                      <i class="fas fa-eye"></i> View All
                  </button>
                  <button id="search-schedule-btn" class="btn btn-secondary btn-custom">
                      <i class="fas fa-search"></i> Search
                  </button>
              </div>

              <div id="add-schedule-form" style="display: none; margin-top: 15px;">
                  <h4>Add Schedule</h4>
                  <form id="add-schedule-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="add-class-id" class="form-label">Class ID:</label>
                          <input type="number" id="add-class-id" name="C_id" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="add-day" class="form-label">Day:</label>
                          <input type="text" id="add-day" name="day" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="add-start-time" class="form-label">Start Time:</label>
                          <input type="time" id="add-start-time" name="start_time" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="add-end-time" class="form-label">End Time:</label>
                          <input type="time" id="add-end-time" name="end_time" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-secondary" id="cancel-add-schedule-btn">Cancel</button>
                  </form>
              </div>

              <div id="delete-schedule-form" style="display: none; margin-top: 15px;">
                  <h4>Delete Schedule</h4>
                  <form id="delete-schedule-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="delete-schedule-id" class="form-label">Schedule ID to Delete:</label>
                          <input type="number" id="delete-schedule-id" name="S_id" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-danger">Delete</button>
                      <button type="button" class="btn btn-secondary" id="cancel-delete-schedule-btn">Cancel</button>
                  </form>
              </div>

              <div id="view-all-schedules" style="display: none; margin-top: 15px;">
                  <h4>All Schedules</h4>
                  <div id="schedules-list" class="mt-3">
                      <!-- Schedules list will be populated here -->
                  </div>
                  <button type="button" class="btn btn-secondary mt-2" id="close-view-all-schedule-btn">Close</button>
              </div>

              <div id="search-schedule-form" style="display: none; margin-top: 15px;">
                  <h4>Search Schedule</h4>
                  <form id="search-schedule-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="search-schedule-id" class="form-label">Schedule ID to Search:</label>
                          <input type="number" id="search-schedule-id" name="S_id" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-secondary">Search</button>
                      <button type="button" class="btn btn-secondary" id="cancel-search-schedule-btn">Cancel</button>
                  </form>
                  <div id="search-schedule-results" class="mt-3" style="display: none;">
                      <h5>Search Results:</h5>
                      <div id="schedule-search-list"></div>
                  </div>
              </div>
          </div>

          <!-- Subscription Form -->
          <div id="subscription-form" class="form-container">
              <h3>Manage Subscription Plans</h3>
              <div class="button-group">
                  <button id="add-subscription-btn" class="btn btn-success btn-custom">
                      <i class="fas fa-plus"></i> Add
                  </button>
                  <button id="edit-subscription-btn" class="btn btn-warning btn-custom">
                      <i class="fas fa-edit"></i> Edit
                  </button>
                  <button id="delete-subscription-btn" class="btn btn-danger btn-custom">
                      <i class="fas fa-trash"></i> Delete
                  </button>
                  <button id="view-all-subscription-btn" class="btn btn-info btn-custom">
                    <i class="fas fa-eye"></i> View All
                </button>
                  <button id="update-subscription-btn" class="btn btn-primary btn-custom">
                      <i class="fas fa-sync"></i> Update
                  </button>
                  <button id="search-subscription-btn" class="btn btn-secondary btn-custom">
                      <i class="fas fa-search"></i> Search
                  </button>
              </div>

              <div id="add-subscription-form" style="display: none; margin-top: 15px;">
                  <h4>Add Subscription Plan</h4>
                  <form id="add-subscription-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="add-plan-name" class="form-label">Plan Name:</label>
                          <input type="text" id="add-plan-name" name="Plan_name" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="add-duration" class="form-label">Duration (days):</label>
                          <input type="number" id="add-duration" name="Duration" class="form-control" min="1" required>
                      </div>
                      <div class="mb-2">
                          <label for="add-price" class="form-label">Price:</label>
                          <input type="number" step="0.01" id="add-price" name="Price" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="add-features" class="form-label">Features (comma-separated):</label>
                          <textarea id="add-features" name="Feature" class="form-control" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-secondary" id="cancel-add-subscription-btn">Cancel</button>
                  </form>
              </div>

              <div id="edit-subscription-form" style="display: none; margin-top: 15px;">
                  <h4>Edit Subscription Plan</h4>
                  <form id="edit-subscription-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="edit-sub-id" class="form-label">Subscription ID to Edit:</label>
                          <input type="number" id="edit-sub-id" name="Sub_id" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="edit-plan-name" class="form-label">New Plan Name:</label>
                          <input type="text" id="edit-plan-name" name="Plan_name" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="edit-duration" class="form-label">New Duration (days):</label>
                          <input type="number" id="edit-duration" name="Duration" class="form-control" min="1" required>
                      </div>
                      <div class="mb-2">
                          <label for="edit-price" class="form-label">New Price:</label>
                          <input type="number" step="0.01" id="edit-price" name="Price" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="edit-features" class="form-label">New Features (comma-separated):</label>
                          <textarea id="edit-features" name="Feature" class="form-control" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                      <button type="button" class="btn btn-secondary" id="cancel-edit-subscription-btn">Cancel</button>
                  </form>
              </div>

              <div id="delete-subscription-form" style="display: none; margin-top: 15px;">
                  <h4>Delete Subscription Plan</h4>
                  <form id="delete-subscription-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="delete-sub-id" class="form-label">Subscription ID to Delete:</label>
                          <input type="number" id="delete-sub-id" name="Sub_id" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-danger">Delete</button>
                      <button type="button" class="btn btn-secondary" id="cancel-delete-subscription-btn">Cancel</button>
                  </form>
              </div>
<!-- View All Subscriptions -->
<div id="view-all-subscriptions" style="display: none; margin-top: 15px;">
    <h4>All Subscription Plans</h4>
    <div id="subscriptions-list" class="mt-3"></div>
    <button type="button" class="btn btn-secondary mt-2" id="close-view-all-subscription-btn">Close</button>
</div>


              <div id="update-subscription-form" style="display: none; margin-top: 15px;">
                  <h4>Update Subscription Plan</h4>
                  <form id="update-subscription-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="update-sub-id" class="form-label">Subscription ID to Update:</label>
                          <input type="number" id="update-sub-id" name="Sub_id" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="update-plan-name" class="form-label">New Plan Name:</label>
                          <input type="text" id="update-plan-name" name="Plan_name" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="update-duration" class="form-label">New Duration (days):</label>
                          <input type="number" id="update-duration" name="Duration" class="form-control" min="1" required>
                      </div>
                      <div class="mb-2">
                          <label for="update-price" class="form-label">New Price:</label>
                          <input type="number" step="0.01" id="update-price" name="Price" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label for="update-features" class="form-label">New Features (comma-separated):</label>
                          <textarea id="update-features" name="Feature" class="form-control" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Update</button>
                      <button type="button" class="btn btn-secondary" id="cancel-update-subscription-btn">Cancel</button>
                  </form>
              </div>

              <div id="search-subscription-form" style="display: none; margin-top: 15px;">
                  <h4>Search Subscription Plan</h4>
                  <form id="search-subscription-form-element">
                      @csrf
                      <div class="mb-2">
                          <label for="search-sub-id" class="form-label">Subscription ID to Search:</label>
                          <input type="number" id="search-sub-id" name="Sub_id" class="form-control" required>
                      </div>
                      <button type="submit" class="btn btn-secondary">Search</button>
                      <button type="button" class="btn btn-secondary" id="cancel-search-subscription-btn">Cancel</button>
                  </form>
                  <div id="search-subscription-results" class="mt-3" style="display: none;">
                      <h5>Search Results:</h5>
                      <div id="subscription-search-list"></div>
                  </div>
              </div>
          </div>

         <!-- Payment Form -->
<div id="payment-form" class="form-container">
    <h3>Manage Payments</h3>
    <div class="button-group">
        <button id="add-payment-btn" class="btn btn-success btn-custom">
            <i class="fas fa-plus"></i> Add
        </button>
        <button id="edit-payment-btn" class="btn btn-warning btn-custom">
            <i class="fas fa-edit"></i> Edit
        </button>
        <button id="delete-payment-btn" class="btn btn-danger btn-custom">
            <i class="fas fa-trash"></i> Delete
        </button>
        <button id="view-payment-btn" class="btn btn-info btn-custom">
            <i class="fas fa-eye"></i> View All
        </button>
    </div>

    <!-- Add Payment Form -->
    <div id="add-payment-form" style="display: none; margin-top: 15px;">
        <h4>Add Payment</h4>
        <form id="add-payment-form-element">
            @csrf
            <div class="mb-2">
                <label for="add-member-id" class="form-label">Member ID:</label>
                <select id="add-member-id" name="member_id" class="form-control" required>
                    <option value="">Select Member</option>
                    @foreach(\App\Models\User::where('role', 'customer')->get() as $member)
                        <option value="{{ $member->id }}">{{ $member->name }} (ID: {{ $member->id }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-2">
                <label for="add-p-mode" class="form-label">Payment Mode:</label>
                <input type="text" id="add-p-mode" name="P_mode" class="form-control" required>
            </div>
            <div class="mb-2">
                <label for="add-p-date" class="form-label">Payment Date:</label>
                <input type="date" id="add-p-date" name="P_date" class="form-control" required>
            </div>
            <div class="mb-2">
                <label for="add-amount" class="form-label">Amount:</label>
                <input type="number" step="0.01" id="add-amount" name="amount" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" id="cancel-add-payment-btn">Cancel</button>
        </form>
    </div>

    <!-- Edit Payment Form -->
    <div id="edit-payment-form" style="display: none; margin-top: 15px;">
        <h4>Edit Payment</h4>
        <form id="edit-payment-form-element">
            @csrf
            <div class="mb-2">
                <label for="edit-p-id" class="form-label">Payment ID to Edit:</label>
                <input type="number" id="edit-p-id" name="P_ID" class="form-control" required>
            </div>
            <div class="mb-2">
                <label for="edit-member-id" class="form-label">Member ID:</label>
                <select id="edit-member-id" name="member_id" class="form-control" required>
                    <option value="">Select Member</option>
                    @foreach(\App\Models\User::where('role', 'customer')->get() as $member)
                        <option value="{{ $member->id }}">{{ $member->name }} (ID: {{ $member->id }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-2">
                <label for="edit-p-mode" class="form-label">Payment Mode:</label>
                <input type="text" id="edit-p-mode" name="P_mode" class="form-control" required>
            </div>
            <div class="mb-2">
                <label for="edit-p-date" class="form-label">Payment Date:</label>
                <input type="date" id="edit-p-date" name="P_date" class="form-control" required>
            </div>
            <div class="mb-2">
                <label for="edit-amount" class="form-label">Amount:</label>
                <input type="number" step="0.01" id="edit-amount" name="amount" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <button type="button" class="btn btn-secondary" id="cancel-edit-payment-btn">Cancel</button>
        </form>
    </div>

    <!-- Delete Payment Form -->
    <div id="delete-payment-form" style="display: none; margin-top: 15px;">
        <h4>Delete Payment</h4>
        <form id="delete-payment-form-element">
            @csrf
            <div class="mb-2">
                <label for="delete-p-id" class="form-label">Payment ID to Delete:</label>
                <input type="number" id="delete-p-id" name="P_ID" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-danger">Delete</button>
            <button type="button" class="btn btn-secondary" id="cancel-delete-payment-btn">Cancel</button>
        </form>
    </div>

    <!-- View Payment Form -->
    <div id="view-payment-form" style="display: none; margin-top: 15px;">
        <h4>View Payment</h4>
        <form id="view-payment-form-element">
            @csrf
            <div class="mb-2">
                <label for="view-p-id" class="form-label">Payment ID to View:</label>
                <input type="number" id="view-p-id" name="P_ID" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-info">View</button>
            <button type="button" class="btn btn-secondary" id="cancel-view-payment-btn">Cancel</button>
        </form>
        <div id="payment-info" style="display: none; margin-top: 15px;">
            <h5>Payment Details</h5>
            <p><strong>Payment ID:</strong> <span id="view-p-id-display"></span></p>
            <p><strong>Member ID:</strong> <span id="view-member-id"></span></p>
            <p><strong>Payment Mode:</strong> <span id="view-p-mode"></span></p>
            <p><strong>Payment Date:</strong> <span id="view-p-date"></span></p>
            <p><strong>Amount:</strong> <span id="view-amount"></span></p>
            <p><strong>Created At:</strong> <span id="view-payment-created"></span></p>
        </div>
    </div>
</div>
      </div>

        <!-- Scripts for Customer Buttons -->
        <script>
            document.getElementById("add-customer-btn").addEventListener("click", function() {
                toggleCustomerForm();
            });
            document.getElementById("cancel-btn-customer").addEventListener("click", function() {
                toggleCustomerForm();
            });
            function toggleCustomerForm() {
                let form = document.getElementById("add-customer-form");
                form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
            }
            document.getElementById("customer-form-element").addEventListener("submit", function(event) {
                event.preventDefault();
                let formData = {
                    name: document.getElementById("customer-name").value,
                    email: document.getElementById("customer-email").value,
                    role: document.getElementById("role").value,
                    _token: "{{ csrf_token() }}"
                };
                fetch("{{ route('admin.addCustomer') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toast(data.success);
                        toggleCustomerForm();
                        location.reload();
                    } else {
                        toast(data.error);
                    }
                })
                .catch(error => console.error("Error:", error));
            });

            document.getElementById("delete-customer-btn").addEventListener("click", function() {
                toggleDeleteForm();
            });
            document.getElementById("cancel-delete-btn").addEventListener("click", function() {
                toggleDeleteForm();
            });
            function toggleDeleteForm() {
                let form = document.getElementById("delete-customer-form");
                form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
            }
            document.getElementById("delete-customer-form-element").addEventListener("submit", function(event) {
                event.preventDefault();
                let formData = {
                    email: document.getElementById("delete-customer-email").value,
                    _token: "{{ csrf_token() }}"
                };
                fetch("{{ route('admin.deleteCustomer') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toast(data.success);
                        toggleDeleteForm();
                        location.reload();
                    } else {
                        toast(data.error);
                    }
                })
                .catch(error => console.error("Error:", error));
            });

            document.getElementById("edit-customer-btn").addEventListener("click", function() {
                toggleEditForm();
            });
            document.getElementById("cancel-edit-btn").addEventListener("click", function() {
                toggleEditForm();
            });
            function toggleEditForm() {
                let form = document.getElementById("edit-customer-form");
                form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
            }
            document.getElementById("edit-customer-form-element").addEventListener("submit", function(event) {
                event.preventDefault();
                let formData = {
                    email: document.getElementById("edit-customer-email").value,
                    name: document.getElementById("edit-customer-name").value,
                    role: document.getElementById("edit-customer-role").value,
                    _token: "{{ csrf_token() }}"
                };
                fetch("{{ route('admin.editCustomer') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toast(data.success);
                        toggleEditForm();
                        location.reload();
                    } else {
                        toast(data.error);
                    }
                })
                .catch(error => console.error("Error:", error));
            });

            document.getElementById("view-customer-btn").addEventListener("click", function() {
                toggleViewForm();
            });
            document.getElementById("cancel-view-btn").addEventListener("click", function() {
                toggleViewForm();
            });
            function toggleViewForm() {
                let form = document.getElementById("view-customer-form");
                let info = document.getElementById("customer-info");
                form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
                if (form.style.display === "none") {
                    info.style.display = "none";
                }
            }
            document.getElementById("view-customer-form-element").addEventListener("submit", function(event) {
                event.preventDefault();
                let formData = {
                    email: document.getElementById("view-customer-email").value,
                    _token: "{{ csrf_token() }}"
                };
                fetch("{{ route('admin.viewCustomer') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById("view-customer-name").textContent = data.customer.name;
                        document.getElementById("view-customer-email-display").textContent = data.customer.email;
                        document.getElementById("view-customer-role").textContent = data.customer.role;
                        document.getElementById("view-customer-created").textContent = data.customer.created_at;
                        document.getElementById("customer-info").style.display = "block";
                    } else {
                        toast(data.error);
                    }
                })
                .catch(error => console.error("Error:", error));
            });

            document.getElementById("update-customer-btn").addEventListener("click", function() {
                toggleUpdateForm();
            });
            document.getElementById("cancel-update-btn").addEventListener("click", function() {
                toggleUpdateForm();
            });
            function toggleUpdateForm() {
                let form = document.getElementById("update-customer-form");
                form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
            }
            document.getElementById("update-customer-form-element").addEventListener("submit", function(event) {
                event.preventDefault();
                let formData = {
                    email: document.getElementById("update-customer-email").value,
                    name: document.getElementById("update-customer-name").value,
                    role: document.getElementById("update-customer-role").value,
                    _token: "{{ csrf_token() }}"
                };
                fetch("{{ route('admin.updateCustomer') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toast(data.success);
                        toggleUpdateForm();
                        location.reload();
                    } else {
                        toast(data.error);
                    }
                })
                .catch(error => console.error("Error:", error));
            });

            document.getElementById("view-all-customers-btn").addEventListener("click", function() {
                toggleViewAllCustomers();
                fetchAllCustomers();
            });
            document.getElementById("close-view-all-btn").addEventListener("click", function() {
                toggleViewAllCustomers();
            });
            function toggleViewAllCustomers() {
                let section = document.getElementById("view-all-customers");
                section.style.display = (section.style.display === "none" || section.style.display === "") ? "block" : "none";
            }
            function fetchAllCustomers() {
                fetch("{{ route('admin.viewAllCustomers') }}", {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let customersList = document.getElementById("customers-list");
                        customersList.innerHTML = "";
                        if (data.customers.length === 0) {
                            customersList.innerHTML = "<p>No customers found.</p>";
                        } else {
                            let table = `
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            `;
                            data.customers.forEach(customer => {
                                table += `
                                    <tr>
                                        <td>${customer.name}</td>
                                        <td>${customer.email}</td>
                                        <td>${customer.role}</td>
                                        <td>${customer.created_at}</td>
                                    </tr>
                                `;
                            });
                            table += `
                                    </tbody>
                                </table>
                            `;
                            customersList.innerHTML = table;
                        }
                    } else {
                        toast(data.error);
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        </script>












<!-- Add this at the bottom of your existing scripts in dashboard.blade.php -->
<script>
    // Show/hide the add equipment form when clicking the Add button
    document.getElementById("add-equipment-btn").addEventListener("click", function() {
        toggleEquipmentForm();
    });

    // Hide the form when clicking Cancel
    document.getElementById("cancel-btn-equipment").addEventListener("click", function() {
        toggleEquipmentForm();
    });

    // Toggle form visibility
    function toggleEquipmentForm() {
        let form = document.getElementById("add-equipment-form"); // Changed to target the form container
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }

    // Handle form submission
    document.getElementById("equipment-form-element").addEventListener("submit", function(event) {
        event.preventDefault();

        // Collect form data
        let formData = {
            name: document.getElementById("equipment-name").value,
            quantity: document.getElementById("quantity").value,
            maintenance_day: document.getElementById("maintenance_day").value,
            _token: document.querySelector('input[name="_token"]').value // Get CSRF token from form
        };

        // Make POST request to server
        fetch("{{ route('admin.addEquipment') }}", {  // Replace with your actual route
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast("Equipment added successfully!");
                toggleEquipmentForm(); // Hide the form
                document.getElementById("equipment-form-element").reset(); // Reset form fields
                location.reload(); // Refresh the page
            } else {
                toast(data.error || "Failed to add equipment");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            toast("An error occurred while adding the equipment");
        });
    });
    // Edit Equipment
document.getElementById("edit-equipment-btn").addEventListener("click", function() {
    toggleEditEquipmentForm();
});
document.getElementById("cancel-edit-equipment-btn").addEventListener("click", function() {
    toggleEditEquipmentForm();
});
function toggleEditEquipmentForm() {
    let form = document.getElementById("edit-equipment-form");
    form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
}
document.getElementById("edit-equipment-form-element").addEventListener("submit", function(event) {
    event.preventDefault();
    let formData = {
        name: document.getElementById("edit-equipment-name").value,
        quantity: document.getElementById("edit-equipment-quantity").value,
        maintenance_day: document.getElementById("edit-maintenance-day").value,
        _token: document.querySelector('input[name="_token"]').value
    };
    fetch("{{ route('admin.editEquipment') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            toast(data.success);
            toggleEditEquipmentForm();
            location.reload();
        } else {
            toast(data.error);
        }
    })
    .catch(error => console.error("Error:", error));
});

// Delete Equipment
document.getElementById("delete-equipment-btn").addEventListener("click", function() {
    toggleDeleteEquipmentForm();
});
document.getElementById("cancel-delete-equipment-btn").addEventListener("click", function() {
    toggleDeleteEquipmentForm();
});
function toggleDeleteEquipmentForm() {
    let form = document.getElementById("delete-equipment-form");
    form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
}
document.getElementById("delete-equipment-form-element").addEventListener("submit", function(event) {
    event.preventDefault();
    let formData = {
        name: document.getElementById("delete-equipment-name").value,
        _token: document.querySelector('input[name="_token"]').value
    };
    fetch("{{ route('admin.deleteEquipment') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            toast(data.success);
            toggleDeleteEquipmentForm();
            location.reload();
        } else {
            toast(data.error);
        }
    })
    .catch(error => console.error("Error:", error));
});

// View Equipment
document.getElementById("view-equipment-btn").addEventListener("click", function() {
    toggleViewEquipmentForm();
});
document.getElementById("cancel-view-equipment-btn").addEventListener("click", function() {
    toggleViewEquipmentForm();
});
function toggleViewEquipmentForm() {
    let form = document.getElementById("view-equipment-form");
    let info = document.getElementById("equipment-info");
    form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    if (form.style.display === "none") {
        info.style.display = "none";
    }
}
document.getElementById("view-equipment-form-element").addEventListener("submit", function(event) {
    event.preventDefault();
    let formData = {
        name: document.getElementById("view-equipment-name").value,
        _token: document.querySelector('input[name="_token"]').value
    };
    fetch("{{ route('admin.viewEquipment') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("view-equipment-name-display").textContent = data.equipment.name;
            document.getElementById("view-equipment-quantity").textContent = data.equipment.quantity;
            document.getElementById("view-equipment-maintenance").textContent = data.equipment.maintenance_day;
            document.getElementById("view-equipment-created").textContent = data.equipment.created_at;
            document.getElementById("equipment-info").style.display = "block";
        } else {
            toast(data.error);
        }
    })
    .catch(error => console.error("Error:", error));
});

// Update Equipment
document.getElementById("update-equipment-btn").addEventListener("click", function() {
    toggleUpdateEquipmentForm();
});
document.getElementById("cancel-update-equipment-btn").addEventListener("click", function() {
    toggleUpdateEquipmentForm();
});
function toggleUpdateEquipmentForm() {
    let form = document.getElementById("update-equipment-form");
    form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
}
document.getElementById("update-equipment-form-element").addEventListener("submit", function(event) {
    event.preventDefault();
    let formData = {
        name: document.getElementById("update-equipment-name").value,
        quantity: document.getElementById("update-equipment-quantity").value,
        maintenance_day: document.getElementById("update-maintenance-day").value,
        _token: document.querySelector('input[name="_token"]').value
    };
    fetch("{{ route('admin.updateEquipment') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            toast(data.success);
            toggleUpdateEquipmentForm();
            location.reload();
        } else {
            toast(data.error);
        }
    })
    .catch(error => console.error("Error:", error));
});

// Search Equipment
document.getElementById("search-equipment-btn").addEventListener("click", function() {
    toggleSearchEquipmentForm();
});
document.getElementById("cancel-search-equipment-btn").addEventListener("click", function() {
    toggleSearchEquipmentForm();
});
function toggleSearchEquipmentForm() {
    let form = document.getElementById("search-equipment-form");
    let results = document.getElementById("search-equipment-results");
    form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    if (form.style.display === "none") {
        results.style.display = "none";
    }
}
document.getElementById("search-equipment-form-element").addEventListener("submit", function(event) {
    event.preventDefault();
    let formData = {
        name: document.getElementById("search-equipment-name").value,
        _token: document.querySelector('input[name="_token"]').value
    };
    fetch("{{ route('admin.searchEquipment') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let results = document.getElementById("equipment-search-list");
            results.innerHTML = "";
            if (data.equipment) {
                results.innerHTML = `
                    <p><strong>Name:</strong> ${data.equipment.name}</p>
                    <p><strong>Quantity:</strong> ${data.equipment.quantity}</p>
                    <p><strong>Maintenance Date:</strong> ${data.equipment.maintenance_day}</p>
                    <p><strong>Created At:</strong> ${data.equipment.created_at}</p>
                `;
            } else {
                results.innerHTML = "<p>No equipment found.</p>";
            }
            document.getElementById("search-equipment-results").style.display = "block";
        } else {
            toast(data.error);
        }
    })
    .catch(error => console.error("Error:", error));
});
</script>





<!--trainer-->
<!-- Scripts for Trainer Buttons -->
<script>



    // Add Trainer
    document.getElementById("add-trainer-btn").addEventListener("click", function() {
        toggleAddTrainerForm();
    });
    document.getElementById("cancel-add-trainer-btn").addEventListener("click", function() {
        toggleAddTrainerForm();
    });
    function toggleAddTrainerForm() {
        let form = document.getElementById("add-trainer-form");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }
    document.getElementById("trainer-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            name: document.getElementById("trainer-name").value,
            email: document.getElementById("trainer-email").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.addTrainer') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast(data.success);
                toggleAddTrainerForm();
                location.reload();
            } else {
                toast(data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    });

    // Edit Trainer
    document.getElementById("edit-trainer-btn").addEventListener("click", function() {
        toggleEditTrainerForm();
    });
    document.getElementById("cancel-edit-trainer-btn").addEventListener("click", function() {
        toggleEditTrainerForm();
    });
    function toggleEditTrainerForm() {
        let form = document.getElementById("edit-trainer-form");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }
    document.getElementById("edit-trainer-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            email: document.getElementById("edit-trainer-email").value,
            name: document.getElementById("edit-trainer-name").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.editTrainer') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast(data.success);
                toggleEditTrainerForm();
                location.reload();
            } else {
                toast(data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    });

    // Delete Trainer
    document.getElementById("delete-trainer-btn").addEventListener("click", function() {
        toggleDeleteTrainerForm();
    });
    document.getElementById("cancel-delete-trainer-btn").addEventListener("click", function() {
        toggleDeleteTrainerForm();
    });
    function toggleDeleteTrainerForm() {
        let form = document.getElementById("delete-trainer-form");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }
    document.getElementById("delete-trainer-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            email: document.getElementById("delete-trainer-email").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.deleteTrainer') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast(data.success);
                toggleDeleteTrainerForm();
                location.reload();
            } else {
                toast(data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    });

    // View Trainer
    document.getElementById("view-trainer-btn").addEventListener("click", function() {
        toggleViewTrainerForm();
    });
    document.getElementById("cancel-view-trainer-btn").addEventListener("click", function() {
        toggleViewTrainerForm();
    });
    function toggleViewTrainerForm() {
        let form = document.getElementById("view-trainer-form");
        let info = document.getElementById("trainer-info");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
        if (form.style.display === "none") {
            info.style.display = "none";
        }
    }
    document.getElementById("view-trainer-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            email: document.getElementById("view-trainer-email").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.viewTrainer') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById("view-trainer-name").textContent = data.trainer.name;
                document.getElementById("view-trainer-email-display").textContent = data.trainer.email;
                document.getElementById("view-trainer-role").textContent = data.trainer.role;
                document.getElementById("view-trainer-created").textContent = data.trainer.created_at;
                document.getElementById("trainer-info").style.display = "block";
            } else {
                toast(data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    });

    // Update Trainer
    document.getElementById("update-trainer-btn").addEventListener("click", function() {
        toggleUpdateTrainerForm();
    });
    document.getElementById("cancel-update-trainer-btn").addEventListener("click", function() {
        toggleUpdateTrainerForm();
    });
    function toggleUpdateTrainerForm() {
        let form = document.getElementById("update-trainer-form");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }
    document.getElementById("update-trainer-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            email: document.getElementById("update-trainer-email").value,
            name: document.getElementById("update-trainer-name").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.updateTrainer') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast(data.success);
                toggleUpdateTrainerForm();
                location.reload();
            } else {
                toast(data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    });

    // Search Trainer
    document.getElementById("search-trainer-btn").addEventListener("click", function() {
        toggleSearchTrainerForm();
    });
    document.getElementById("cancel-search-trainer-btn").addEventListener("click", function() {
        toggleSearchTrainerForm();
    });
    function toggleSearchTrainerForm() {
        let form = document.getElementById("search-trainer-form");
        let results = document.getElementById("search-trainer-results");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
        if (form.style.display === "none") {
            results.style.display = "none";
        }
    }
    document.getElementById("search-trainer-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            email: document.getElementById("search-trainer-email").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.searchTrainer') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let results = document.getElementById("trainer-search-list");
                results.innerHTML = "";
                if (data.trainer) {
                    results.innerHTML = `
                        <p><strong>Name:</strong> ${data.trainer.name}</p>
                        <p><strong>Email:</strong> ${data.trainer.email}</p>
                        <p><strong>Role:</strong> ${data.trainer.role}</p>
                        <p><strong>Created At:</strong> ${data.trainer.created_at}</p>
                    `;
                } else {
                    results.innerHTML = "<p>No trainer found.</p>";
                }
                document.getElementById("search-trainer-results").style.display = "block";
            } else {
                toast(data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    });
    </script>
    <!-- Scripts for Feedback Buttons -->
<script>
    // Add Feedback
    document.getElementById("add-feedback-btn").addEventListener("click", function() {
        toggleAddFeedbackForm();
    });
    document.getElementById("cancel-add-feedback-btn").addEventListener("click", function() {
        toggleAddFeedbackForm();
    });
    function toggleAddFeedbackForm() {
        let form = document.getElementById("add-feedback-form");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }
    document.getElementById("add-feedback-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            user_id: document.getElementById("add-feedback-user-id").value,
            feedback_text: document.getElementById("add-feedback-text").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.addFeedback') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast(data.success);
                toggleAddFeedbackForm();
                setTimeout(() => location.reload(), 500);
            } else {
                toast(data.error || "Unknown error occurred");
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
            toast("An error occurred: " + error.message);
        });
    });

    // Edit Feedback
    document.getElementById("edit-feedback-btn").addEventListener("click", function() {
        toggleEditFeedbackForm();
    });
    document.getElementById("cancel-edit-feedback-btn").addEventListener("click", function() {
        toggleEditFeedbackForm();
    });
    function toggleEditFeedbackForm() {
        let form = document.getElementById("edit-feedback-form");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }
    document.getElementById("edit-feedback-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            feedback_id: document.getElementById("edit-feedback-id").value,
            feedback_text: document.getElementById("edit-feedback-text").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.editFeedback') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast(data.success);
                toggleEditFeedbackForm();
                setTimeout(() => location.reload(), 500);
            } else {
                toast(data.error || "Unknown error occurred");
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
            toast("An error occurred: " + error.message);
        });
    });

    // Delete Feedback
    document.getElementById("delete-feedback-btn").addEventListener("click", function() {
        toggleDeleteFeedbackForm();
    });
    document.getElementById("cancel-delete-feedback-btn").addEventListener("click", function() {
        toggleDeleteFeedbackForm();
    });
    function toggleDeleteFeedbackForm() {
        let form = document.getElementById("delete-feedback-form");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }
    document.getElementById("delete-feedback-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            feedback_id: document.getElementById("delete-feedback-id").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.deleteFeedback') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast(data.success);
                toggleDeleteFeedbackForm();
                setTimeout(() => location.reload(), 500);
            } else {
                toast(data.error || "Unknown error occurred");
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
            toast("An error occurred: " + error.message);
        });
    });

    // View All Feedback
    document.getElementById("view-feedback-btn").addEventListener("click", function() {
        toggleViewAllFeedback();
        fetchAllFeedback();
    });
    document.getElementById("close-view-all-feedback-btn").addEventListener("click", function() {
        toggleViewAllFeedback();
    });
    function toggleViewAllFeedback() {
        let section = document.getElementById("view-all-feedback");
        section.style.display = (section.style.display === "none" || section.style.display === "") ? "block" : "none";
    }
    function fetchAllFeedback() {
        fetch("{{ route('admin.viewAllFeedback') }}", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let feedbackList = document.getElementById("feedback-list");
                feedbackList.innerHTML = "";
                if (data.feedback.length === 0) {
                    feedbackList.innerHTML = "<p>No feedback found.</p>";
                } else {
                    let table = `
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Feedback ID</th>
                                    <th>User ID</th>
                                    <th>Feedback Text</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;
                    data.feedback.forEach(item => {
                        table += `
                            <tr>
                                <td>${item.feedback_id}</td>
                                <td>${item.user_id}</td>
                                <td>${item.feedback_text}</td>
                                <td>${item.created_at}</td>
                            </tr>
                        `;
                    });
                    table += `
                            </tbody>
                        </table>
                    `;
                    feedbackList.innerHTML = table;
                }
            } else {
                toast(data.error || "Unknown error occurred");
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
            toast("An error occurred: " + error.message);
        });
    }

    // Update Feedback
    document.getElementById("update-feedback-btn").addEventListener("click", function() {
        toggleUpdateFeedbackForm();
    });
    document.getElementById("cancel-update-feedback-btn").addEventListener("click", function() {
        toggleUpdateFeedbackForm();
    });
    function toggleUpdateFeedbackForm() {
        let form = document.getElementById("update-feedback-form");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }
    document.getElementById("update-feedback-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            feedback_id: document.getElementById("update-feedback-id").value,
            feedback_text: document.getElementById("update-feedback-text").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.updateFeedback') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast(data.success);
                toggleUpdateFeedbackForm();
                setTimeout(() => location.reload(), 500);
            } else {
                toast(data.error || "Unknown error occurred");
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
            toast("An error occurred: " + error.message);
        });
    });

    // Search Feedback
    document.getElementById("search-feedback-btn").addEventListener("click", function() {
        toggleSearchFeedbackForm();
    });
    document.getElementById("cancel-search-feedback-btn").addEventListener("click", function() {
        toggleSearchFeedbackForm();
    });
    function toggleSearchFeedbackForm() {
        let form = document.getElementById("search-feedback-form");
        let results = document.getElementById("search-feedback-results");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
        if (form.style.display === "none") {
            results.style.display = "none";
        }
    }
    document.getElementById("search-feedback-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            feedback_id: document.getElementById("search-feedback-id").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.searchFeedback') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let results = document.getElementById("feedback-search-list");
                results.innerHTML = "";
                if (data.feedback) {
                    results.innerHTML = `
                        <p><strong>Feedback ID:</strong> ${data.feedback.feedback_id}</p>
                        <p><strong>User ID:</strong> ${data.feedback.user_id}</p>
                        <p><strong>Feedback Text:</strong> ${data.feedback.feedback_text}</p>
                        <p><strong>Created At:</strong> ${data.feedback.created_at}</p>
                    `;
                } else {
                    results.innerHTML = "<p>No feedback found.</p>";
                }
                document.getElementById("search-feedback-results").style.display = "block";
            } else {
                toast(data.error || "Unknown error occurred");
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
            toast("An error occurred: " + error.message);
        });
    });
    </script>
  <script>
    // Toggle function for forms
    function toggleForm(formId) {
        let form = document.getElementById(formId);
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }

    // Button event listeners
    document.getElementById("add-class-btn").addEventListener("click", () => toggleForm("add-class-form"));
    document.getElementById("edit-class-btn").addEventListener("click", () => toggleForm("edit-class-form"));
    document.getElementById("delete-class-btn").addEventListener("click", () => toggleForm("delete-class-form"));
    document.getElementById("view-class-btn").addEventListener("click", () => viewAllClasses());
    document.getElementById("update-class-btn").addEventListener("click", () => toggleForm("update-class-form"));
    document.getElementById("search-class-btn").addEventListener("click", () => toggleForm("search-class-form"));

    // Cancel button event listeners
    document.getElementById("cancel-btn-class").addEventListener("click", () => toggleForm("add-class-form"));
    document.getElementById("edit-cancel-btn").addEventListener("click", () => toggleForm("edit-class-form"));
    document.getElementById("delete-cancel-btn").addEventListener("click", () => toggleForm("delete-class-form"));
    document.getElementById("view-cancel-btn").addEventListener("click", () => toggleForm("view-class-form"));
    document.getElementById("update-cancel-btn").addEventListener("click", () => toggleForm("update-class-form"));
    document.getElementById("search-cancel-btn").addEventListener("click", () => toggleForm("search-class-form"));

    // Add Class Form Submission
    document.getElementById("class-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            class_name: document.getElementById("class-name").value,
            max_capacity: document.getElementById("max-capacity").value,
            T_id: document.getElementById("trainer-id").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('classes.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast(data.success);
                toggleForm("add-class-form");
                document.getElementById("class-form-element").reset();
                location.reload();
            } else {
                toast(data.error || "Failed to add class");
            }
        })
        .catch(error => console.error("Error:", error));
    });

    // Edit Class Form Submission
    document.getElementById("edit-class-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            C_id: document.getElementById("edit-class-id").value,
            class_name: document.getElementById("edit-class-name").value,
            max_capacity: document.getElementById("edit-max-capacity").value,
            T_id: document.getElementById("edit-trainer-id").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('classes.edit') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast(data.success);
                toggleForm("edit-class-form");
                location.reload();
            } else {
                toast(data.error || "Failed to edit class");
            }
        })
        .catch(error => console.error("Error:", error));
    });

    // Delete Class Form Submission
    document.getElementById("delete-class-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            C_id: document.getElementById("delete-class-id").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('classes.delete') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast(data.success);
                toggleForm("delete-class-form");
                location.reload();
            } else {
                toast(data.error || "Failed to delete class");
            }
        })
        .catch(error => console.error("Error:", error));
    });

    // View All Classes
    function viewAllClasses() {
        fetch("{{ route('classes.view') }}", {
            method: "GET",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.classes) {
                let classList = document.getElementById("class-list");
                classList.innerHTML = "<ul>";
                data.classes.forEach(cls => {
                    classList.innerHTML += `<li>${cls.class_name} (Capacity: ${cls.max_capacity}, Trainer ID: ${cls.T_id})</li>`;
                });
                classList.innerHTML += "</ul>";
                toggleForm("view-class-form");
            } else {
                toast(data.error || "Failed to fetch classes");
            }
        })
        .catch(error => console.error("Error:", error));
    }

    // Update Class Form Submission
    document.getElementById("update-class-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            C_id: document.getElementById("update-class-id").value,
            class_name: document.getElementById("update-class-name").value,
            max_capacity: document.getElementById("update-max-capacity").value,
            T_id: document.getElementById("update-trainer-id").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('classes.update') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast(data.success);
                toggleForm("update-class-form");
                location.reload();
            } else {
                toast(data.error || "Failed to update class");
            }
        })
        .catch(error => console.error("Error:", error));
    });

    // Search Class Form Submission
    document.getElementById("search-class-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            class_name: document.getElementById("search-class-name").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('classes.search') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.classes) {
                let searchResults = document.getElementById("search-results");
                searchResults.innerHTML = "<ul>";
                data.classes.forEach(cls => {
                    searchResults.innerHTML += `<li>${cls.class_name} (Capacity: ${cls.max_capacity}, Trainer ID: ${cls.T_id})</li>`;
                });
                searchResults.innerHTML += "</ul>";
            } else {
                toast(data.error || "No classes found");
            }
        })
        .catch(error => console.error("Error:", error));
    });
</script>


<script>
    // Add Subscription Plan
    document.getElementById("add-subscription-btn").addEventListener("click", function() {
        toggleAddSubscriptionForm();
    });
    document.getElementById("cancel-add-subscription-btn").addEventListener("click", function() {
        toggleAddSubscriptionForm();
    });
    function toggleAddSubscriptionForm() {
        let form = document.getElementById("add-subscription-form");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }
    document.getElementById("add-subscription-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            Plan_name: document.getElementById("add-plan-name").value,
            Duration: document.getElementById("add-duration").value,
            Price: document.getElementById("add-price").value,
            Feature: document.getElementById("add-features").value.split(',').map(item => item.trim()), // Convert to array
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.addSubscription') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast(data.success);
                toggleAddSubscriptionForm();
                location.reload();
            } else {
                toast(data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    });

    // Edit Subscription Plan
    document.getElementById("edit-subscription-btn").addEventListener("click", function() {
        toggleEditSubscriptionForm();
    });
    document.getElementById("cancel-edit-subscription-btn").addEventListener("click", function() {
        toggleEditSubscriptionForm();
    });
    function toggleEditSubscriptionForm() {
        let form = document.getElementById("edit-subscription-form");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }
    document.getElementById("edit-subscription-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            Sub_id: document.getElementById("edit-sub-id").value,
            Plan_name: document.getElementById("edit-plan-name").value,
            Duration: document.getElementById("edit-duration").value,
            Price: document.getElementById("edit-price").value,
            Feature: document.getElementById("edit-features").value.split(',').map(item => item.trim()), // Convert to array
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.editSubscription') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast(data.success);
                toggleEditSubscriptionForm();
                location.reload();
            } else {
                toast(data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    });

    // Delete Subscription Plan
    document.getElementById("delete-subscription-btn").addEventListener("click", function() {
        toggleDeleteSubscriptionForm();
    });
    document.getElementById("cancel-delete-subscription-btn").addEventListener("click", function() {
        toggleDeleteSubscriptionForm();
    });
    function toggleDeleteSubscriptionForm() {
        let form = document.getElementById("delete-subscription-form");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }
    document.getElementById("delete-subscription-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            Sub_id: document.getElementById("delete-sub-id").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.deleteSubscription') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast(data.success);
                toggleDeleteSubscriptionForm();
                location.reload();
            } else {
                toast(data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    });

    // View All Subscription Plans
    document.getElementById("view-all-subscription-btn").addEventListener("click", function() {
    toggleViewAllSubscriptions();
    fetchAllSubscriptions();
});

document.getElementById("close-view-all-subscription-btn").addEventListener("click", function() {
    toggleViewAllSubscriptions();
});

function toggleViewAllSubscriptions() {
    let section = document.getElementById("view-all-subscriptions");
    section.style.display = (section.style.display === "none" || section.style.display === "") ? "block" : "none";
}

function fetchAllSubscriptions() {
    fetch("{{ route('admin.viewAllSubscriptions') }}", {
        method: "GET",
        headers: {
            "Accept": "application/json"
        }
    })
    .then(response => response.json())
    .then(data => {
        let subscriptionsList = document.getElementById("subscriptions-list");
        subscriptionsList.innerHTML = "";

        if (data.success) {
            if (data.subscriptions.length === 0) {
                subscriptionsList.innerHTML = "<p>No subscriptions found.</p>";
            } else {
                let table = `
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Subscription ID</th>
                                <th>Plan Name</th>
                                <th>Duration (days)</th>
                                <th>Price</th>
                                <th>Features</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                `;
                data.subscriptions.forEach(sub => {
                    let features = Array.isArray(sub.Feature) ? sub.Feature.join(', ') : 'No features available';
                    table += `
                        <tr>
                            <td>${sub.Sub_id}</td>
                            <td>${sub.Plan_name}</td>
                            <td>${sub.Duration}</td>
                            <td>${sub.Price}</td>
                            <td>${features}</td>
                            <td>${sub.created_at}</td>
                        </tr>
                    `;
                });
                table += `
                        </tbody>
                    </table>
                `;
                subscriptionsList.innerHTML = table;
            }
        } else {
            toast(data.error || "An error occurred while fetching subscriptions.");
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
}


    // Update Subscription Plan
    document.getElementById("update-subscription-btn").addEventListener("click", function() {
        toggleUpdateSubscriptionForm();
    });
    document.getElementById("cancel-update-subscription-btn").addEventListener("click", function() {
        toggleUpdateSubscriptionForm();
    });
    function toggleUpdateSubscriptionForm() {
        let form = document.getElementById("update-subscription-form");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }
    document.getElementById("update-subscription-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            Sub_id: document.getElementById("update-sub-id").value,
            Plan_name: document.getElementById("update-plan-name").value,
            Duration: document.getElementById("update-duration").value,
            Price: document.getElementById("update-price").value,
            Feature: document.getElementById("update-features").value.split(',').map(item => item.trim()), // Convert to array
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.updateSubscription') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast(data.success);
                toggleUpdateSubscriptionForm();
                location.reload();
            } else {
                toast(data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    });

    // Search Subscription Plan
    document.getElementById("search-subscription-btn").addEventListener("click", function() {
        toggleSearchSubscriptionForm();
    });
    document.getElementById("cancel-search-subscription-btn").addEventListener("click", function() {
        toggleSearchSubscriptionForm();
    });
    function toggleSearchSubscriptionForm() {
        let form = document.getElementById("search-subscription-form");
        let results = document.getElementById("search-subscription-results");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
        if (form.style.display === "none") {
            results.style.display = "none";
        }
    }
    document.getElementById("search-subscription-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            Sub_id: document.getElementById("search-sub-id").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.searchSubscription') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let results = document.getElementById("subscription-search-list");
                results.innerHTML = "";
                if (data.subscription) {
                    results.innerHTML = `
                        <p><strong>Subscription ID:</strong> ${data.subscription.Sub_id}</p>
                        <p><strong>Plan Name:</strong> ${data.subscription.Plan_name}</p>
                        <p><strong>Duration (days):</strong> ${data.subscription.Duration}</p>
                        <p><strong>Price:</strong> ${data.subscription.Price}</p>
                        <p><strong>Features:</strong> ${data.subscription.Feature.join(', ')}</p>
                        <p><strong>Created At:</strong> ${data.subscription.created_at}</p>
                    `;
                } else {
                    results.innerHTML = "<p>No subscription found.</p>";
                }
                document.getElementById("search-subscription-results").style.display = "block";
            } else {
                toast(data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    });
</script>
<script>
    // Add Schedule
    document.getElementById("add-schedule-btn").addEventListener("click", function() {
        toggleAddScheduleForm();
    });
    document.getElementById("cancel-add-schedule-btn").addEventListener("click", function() {
        toggleAddScheduleForm();
    });
    function toggleAddScheduleForm() {
        let form = document.getElementById("add-schedule-form");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }
    document.getElementById("add-schedule-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            C_id: document.getElementById("add-class-id").value,
            day: document.getElementById("add-day").value,
            start_time: document.getElementById("add-start-time").value,
            end_time: document.getElementById("add-end-time").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.addSchedule') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast(data.success);
                toggleAddScheduleForm();
                location.reload();
            } else {
                toast(data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    });


    // Delete Schedule
    document.getElementById("delete-schedule-btn").addEventListener("click", function() {
        toggleDeleteScheduleForm();
    });
    document.getElementById("cancel-delete-schedule-btn").addEventListener("click", function() {
        toggleDeleteScheduleForm();
    });
    function toggleDeleteScheduleForm() {
        let form = document.getElementById("delete-schedule-form");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }
    document.getElementById("delete-schedule-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            S_id: document.getElementById("delete-schedule-id").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.deleteSchedule') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toast(data.success);
                toggleDeleteScheduleForm();
                location.reload();
            } else {
                toast(data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    });

    // View All Schedules
    document.getElementById("view-schedule-btn").addEventListener("click", function() {
        toggleViewAllSchedules();
        fetchAllSchedules();
    });
    document.getElementById("close-view-all-schedule-btn").addEventListener("click", function() {
        toggleViewAllSchedules();
    });
    function toggleViewAllSchedules() {
        let section = document.getElementById("view-all-schedules");
        section.style.display = (section.style.display === "none" || section.style.display === "") ? "block" : "none";
    }
    function fetchAllSchedules() {
        fetch("{{ route('admin.viewAllSchedules') }}", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let schedulesList = document.getElementById("schedules-list");
                schedulesList.innerHTML = "";
                if (data.schedules.length === 0) {
                    schedulesList.innerHTML = "<p>No schedules found.</p>";
                } else {
                    let table = `
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Schedule ID</th>
                                    <th>Class ID</th>
                                    <th>Day</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;
                    data.schedules.forEach(schedule => {
                        table += `
                            <tr>
                                <td>${schedule.S_id}</td>
                                <td>${schedule.C_id}</td>
                                <td>${schedule.day}</td>
                                <td>${schedule.start_time}</td>
                                <td>${schedule.end_time}</td>
                                <td>${schedule.created_at}</td>
                            </tr>
                        `;
                    });
                    table += `
                            </tbody>
                        </table>
                    `;
                    schedulesList.innerHTML = table;
                }
            } else {
                toast(data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    }






    // Search Schedule
    document.getElementById("search-schedule-btn").addEventListener("click", function() {
        toggleSearchScheduleForm();
    });
    document.getElementById("cancel-search-schedule-btn").addEventListener("click", function() {
        toggleSearchScheduleForm();
    });
    function toggleSearchScheduleForm() {
        let form = document.getElementById("search-schedule-form");
        let results = document.getElementById("search-schedule-results");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
        if (form.style.display === "none") {
            results.style.display = "none";
        }
    }
    document.getElementById("search-schedule-form-element").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = {
            S_id: document.getElementById("search-schedule-id").value,
            _token: document.querySelector('input[name="_token"]').value
        };
        fetch("{{ route('admin.searchSchedule') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let results = document.getElementById("schedule-search-list");
                results.innerHTML = "";
                if (data.schedule) {
                    results.innerHTML = `
                        <p><strong>Schedule ID:</strong> ${data.schedule.S_id}</p>
                        <p><strong>Class ID:</strong> ${data.schedule.C_id}</p>
                        <p><strong>Day:</strong> ${data.schedule.day}</p>
                        <p><strong>Start Time:</strong> ${data.schedule.start_time}</p>
                        <p><strong>End Time:</strong> ${data.schedule.end_time}</p>
                        <p><strong>Created At:</strong> ${data.schedule.created_at}</p>
                    `;
                } else {
                    results.innerHTML = "<p>No schedule found.</p>";
                }
                document.getElementById("search-schedule-results").style.display = "block";
            } else {
                toast(data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    });



</script>








<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Add Payment
        const addBtn = document.getElementById("add-payment-btn");
        const cancelAddBtn = document.getElementById("cancel-add-payment-btn");
        const addForm = document.getElementById("add-payment-form-element");

        function toggleAddPaymentForm() {
            let form = document.getElementById("add-payment-form");
            form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
        }

        addBtn.addEventListener("click", toggleAddPaymentForm);
        cancelAddBtn.addEventListener("click", toggleAddPaymentForm);
        addForm.addEventListener("submit", function(event) {
            event.preventDefault();
            let formData = {
                member_id: document.getElementById("add-member-id").value,
                P_mode: document.getElementById("add-p-mode").value,
                P_date: document.getElementById("add-p-date").value,
                amount: document.getElementById("add-amount").value,
                _token: document.querySelector('input[name="_token"]').value
            };
            fetch("{{ route('admin.addPayment') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                    "Accept": "application/json"
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    toast(data.success);
                    toggleAddPaymentForm();
                    location.reload();
                } else {
                    toast(data.error || "An unknown error occurred");
                }
            })
            .catch(error => {
                console.error("Fetch Error:", error);
                toast("An error occurred: " + error.message);
            });
        });

        // Edit Payment
        const editBtn = document.getElementById("edit-payment-btn");
        const cancelEditBtn = document.getElementById("cancel-edit-payment-btn");
        const editForm = document.getElementById("edit-payment-form-element");

        function toggleEditPaymentForm() {
            let form = document.getElementById("edit-payment-form");
            form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
        }

        editBtn.addEventListener("click", toggleEditPaymentForm);
        cancelEditBtn.addEventListener("click", toggleEditPaymentForm);
        editForm.addEventListener("submit", function(event) {
            event.preventDefault();
            let formData = {
                P_ID: document.getElementById("edit-p-id").value,
                member_id: document.getElementById("edit-member-id").value,
                P_mode: document.getElementById("edit-p-mode").value,
                P_date: document.getElementById("edit-p-date").value,
                amount: document.getElementById("edit-amount").value,
                _token: document.querySelector('input[name="_token"]').value
            };
            console.log('Editing:', formData);
            fetch("{{ route('admin.editPayment') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                    "Accept": "application/json"
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
               if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    toast(data.success);
                    toggleEditPaymentForm();
                    location.reload();
                } else {
                    toast(data.error || "An unknown error occurred");
                }
            })
            .catch(error => {
                console.error("Fetch Error:", error);
                toast("An error occurred: " + error.message);
            });
        });

        // Delete Payment
        const deleteBtn = document.getElementById("delete-payment-btn");
        const cancelDeleteBtn = document.getElementById("cancel-delete-payment-btn");
        const deleteForm = document.getElementById("delete-payment-form-element");

        function toggleDeletePaymentForm() {
            let form = document.getElementById("delete-payment-form");
            form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
        }

        deleteBtn.addEventListener("click", toggleDeletePaymentForm);
        cancelDeleteBtn.addEventListener("click", toggleDeletePaymentForm);
        deleteForm.addEventListener("submit", function(event) {
            event.preventDefault();
            let formData = {
                P_ID: document.getElementById("delete-p-id").value,
                _token: document.querySelector('input[name="_token"]').value
            };
            fetch("{{ route('admin.deletePayment') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                    "Accept": "application/json"
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    toast(data.success);
                    toggleDeletePaymentForm();
                    location.reload();
                } else {
                    toast(data.error || "An unknown error occurred");
                }
            })
            .catch(error => {
                console.error("Fetch Error:", error);
                toast("An error occurred: " + error.message);
            });
        });

        // View Payment
        const viewBtn = document.getElementById("view-payment-btn");
        const cancelViewBtn = document.getElementById("cancel-view-payment-btn");
        const viewForm = document.getElementById("view-payment-form-element");

        function toggleViewPaymentForm() {
            let form = document.getElementById("view-payment-form");
            let info = document.getElementById("payment-info");
            form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
            if (form.style.display === "none") info.style.display = "none";
        }

        viewBtn.addEventListener("click", toggleViewPaymentForm);
        cancelViewBtn.addEventListener("click", toggleViewPaymentForm);
        viewForm.addEventListener("submit", function(event) {
            event.preventDefault();
            let formData = {
                P_ID: document.getElementById("view-p-id").value,
                _token: document.querySelector('input[name="_token"]').value
            };
            fetch("{{ route('admin.viewPayment') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                    "Accept": "application/json"
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    document.getElementById("view-p-id-display").textContent = data.payment.P_ID;
                    document.getElementById("view-member-id").textContent = data.payment.member_id;
                    document.getElementById("view-p-mode").textContent = data.payment.P_mode;
                    document.getElementById("view-p-date").textContent = data.payment.P_date;
                    document.getElementById("view-amount").textContent = data.payment.amount;
                    document.getElementById("view-payment-created").textContent = data.payment.created_at;
                    document.getElementById("payment-info").style.display = "block";
                } else {
                    toast(data.error || "An unknown error occurred");
                }
            })
            .catch(error => {
                console.error("Fetch Error:", error);
                toast("An error occurred: " + error.message);
            });
        });
    });
    </script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
