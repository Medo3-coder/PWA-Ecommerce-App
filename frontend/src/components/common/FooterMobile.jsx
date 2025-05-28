import React from 'react';
import { Link } from 'react-router-dom';
import Apple from '../../assets/images/apple.png';
import Google from '../../assets/images/google.png';
import { useSiteSettings } from '../../hooks/useSiteSettings';

const FooterMobile = () => {
  const { settings } = useSiteSettings();

  return (
    <div className="footer-mobile">
      <div className="footer-mobile-menu">
        <div className="footer-mobile-menu-item">
          <Link to="/" className="footer-mobile-menu-link">
            <i className="bi bi-house-door"></i>
            <small>Home</small>
          </Link>
        </div>
        <div className="footer-mobile-menu-item">
          <Link to="/notification" className="footer-mobile-menu-link">
            <i className="bi bi-bell"></i>
            <small>Notification</small>
          </Link>
        </div>
        <div className="footer-mobile-menu-item">
          <Link to="/cart" className="footer-mobile-menu-link">
            <i className="bi bi-cart"></i>
            <small>Cart</small>
          </Link>
        </div>
        <div className="footer-mobile-menu-item">
          <Link to="/favourite" className="footer-mobile-menu-link">
            <i className="bi bi-heart"></i>
            <small>Favourite</small>
          </Link>
        </div>
      </div>
      <div className="footer-mobile-content">
        <div className="footer-mobile-content-item">
          <Link to="/content/about" className="footer-mobile-content-link">
            About Us
          </Link>
        </div>
        <div className="footer-mobile-content-item">
          <Link to="/content/privacy" className="footer-mobile-content-link">
            Privacy Policy
          </Link>
        </div>
        <div className="footer-mobile-content-item">
          <Link to="/content/refund" className="footer-mobile-content-link">
            Refund Policy
          </Link>
        </div>
        <div className="footer-mobile-content-item">
          <Link to="/content/purchase_guide" className="footer-mobile-content-link">
            Purchase Guide
          </Link>
        </div>
      </div>
      <div className="footer-mobile-app">
        <div className="footer-mobile-app-item">
          <a href={settings.androidAppLink} className="footer-mobile-app-link" target="_blank" rel="noopener noreferrer">
            <img src={Google} alt="Google Play" />
          </a>
        </div>
        <div className="footer-mobile-app-item">
          <a href={settings.iosAppLink} className="footer-mobile-app-link" target="_blank" rel="noopener noreferrer">
            <img src={Apple} alt="App Store" />
          </a>
        </div>
      </div>
    </div>
  );
};

export default FooterMobile;
