<div class="brand-header">
    <div class="brand-container">
        <button class="menu-toggle">
            <i class="fa fa-bars"></i>
        </button>
        
        <div class="brand-title">
            <a href="dashboard.php" class="brand-link">
                <i class="fas fa-tint brand-icon"></i>
                <span class="brand-text">Online Blood Bank & Donor Management System</span>
            </a>
        </div>
        
        <div class="brand-profile">
            <div class="profile-dropdown">
                <a href="#" class="profile-trigger">
                    <img src="img/ts-avatar.jpg" class="profile-avatar" alt="Profile">
                    <span class="profile-name hidden-side">Account</span>
                    <i class="fas fa-chevron-down profile-arrow hidden-side"></i>
                </a>
                <ul class="profile-menu">
                    <li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
                    <li><a href="change-password.php"><i class="fas fa-key"></i> Change Password</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
.brand-header {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: relative;
    z-index: 1000;
}

.brand-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px 20px;
    max-width: 100%;
}

.menu-toggle {
    background: rgba(255,255,255,0.1);
    border: none;
    color: white;
    width: 45px;
    height: 45px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 18px;
}

.menu-toggle:hover {
    background: rgba(255,255,255,0.2);
    transform: scale(1.05);
}

.brand-title {
    flex: 1;
    text-align: center;
    padding: 0 20px;
}

.brand-link {
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    color: white !important;
    font-size: 20px;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
}

.brand-link:hover {
    transform: translateY(-2px);
    text-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.brand-icon {
    margin-right: 12px;
    font-size: 24px;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.brand-text {
    position: relative;
}

.brand-text::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 0;
    height: 2px;
    background: white;
    transition: width 0.3s ease;
}

.brand-link:hover .brand-text::after {
    width: 100%;
}

.brand-profile {
    display: flex;
    align-items: center;
}

.profile-dropdown {
    position: relative;
}

.profile-trigger {
    display: flex;
    align-items: center;
    background: rgba(255,255,255,0.1);
    border: none;
    color: white;
    padding: 8px 15px;
    border-radius: 25px;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
}

.profile-trigger:hover {
    background: rgba(255,255,255,0.2);
    transform: translateY(-2px);
}

.profile-avatar {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    border: 2px solid white;
    margin-right: 10px;
}

.profile-name {
    font-weight: 500;
    margin-right: 8px;
}

.profile-arrow {
    font-size: 12px;
    transition: transform 0.3s ease;
}

.profile-dropdown:hover .profile-arrow {
    transform: rotate(180deg);
}

.profile-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    min-width: 200px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    margin-top: 10px;
    list-style: none;
    padding: 0;
    z-index: 1001;
}

.profile-dropdown:hover .profile-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.profile-menu li {
    border-bottom: 1px solid #f0f0f0;
}

.profile-menu li:last-child {
    border-bottom: none;
}

.profile-menu li a {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    color: #333;
    text-decoration: none;
    transition: all 0.3s ease;
}

.profile-menu li a:hover {
    background: #f8f9fa;
    color: #e74c3c;
}

.profile-menu li a i {
    margin-right: 10px;
    width: 20px;
    text-align: center;
}

/* Responsive Design */
@media (max-width: 768px) {
    .brand-container {
        padding: 12px 15px;
    }
    
    .brand-link {
        font-size: 16px;
    }
    
    .brand-icon {
        font-size: 20px;
        margin-right: 8px;
    }
    
    .profile-name {
        display: none;
    }
    
    .profile-arrow {
        display: none;
    }
    
    .profile-trigger {
        padding: 8px;
    }
    
    .profile-avatar {
        margin-right: 0;
    }
}

@media (max-width: 576px) {
    .brand-text {
        display: none;
    }
    
    .brand-link {
        font-size: 14px;
    }
    
    .brand-icon {
        font-size: 18px;
        margin-right: 0;
    }
}

/* Hidden side class for original functionality */
.hidden-side {
    display: inline-block;
}

@media (max-width: 768px) {
    .hidden-side {
        display: none;
    }
}
</style>

<script>
// Add interactive functionality
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const brandLink = document.querySelector('.brand-link');
    
    // Menu toggle animation
    menuToggle.addEventListener('click', function() {
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
            this.style.transform = 'scale(1)';
        }, 200);
    });
    
    // Brand link hover effect
    brandLink.addEventListener('mouseenter', function() {
        this.querySelector('.brand-icon').style.animation = 'none';
        setTimeout(() => {
            this.querySelector('.brand-icon').style.animation = 'pulse 2s infinite';
        }, 10);
    });
});
</script>