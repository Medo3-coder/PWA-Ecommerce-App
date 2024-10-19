import React, { useEffect, useState } from "react";
import { Col, Container, Row, Spinner } from "react-bootstrap";
import { Link } from "react-router-dom";
import Apple from "../../assets/images/apple.png";
import Google from "../../assets/images/google.png";
import axios from "axios";
import AppURL from "../../utils/AppURL";
import parse from "html-react-parser";
import ToastMessage from "../../toast-messages/toast";

const FooterDesktop = () => {
  const [address, setAddress] = useState("");
  const [androidAppLink, setAndroidAppLink] = useState("");
  const [iosAppLink, setiOSAppLink] = useState("");
  const [facebookLink, setFacebookLink] = useState("");
  const [twitterLink, setTwitterLink] = useState("");
  const [instagramLink, setInstagramLink] = useState("");
  const [copyrightText, setCopyrightText] = useState("");
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    const siteInfo = async () => {
      try {
        const response = await axios.get(AppURL.SiteSettings);
        if (response.status === 200) {
          const siteData = response.data[0];
          setAddress(siteData.address);
          setAndroidAppLink(siteData.android_app_link);
          setiOSAppLink(siteData.ios_app_link);
          setFacebookLink(siteData.facebook_link);
          setTwitterLink(siteData.twitter_link);
          setInstagramLink(siteData.instagram_link);
          setCopyrightText(siteData.copyright_text);
          setIsLoading(false);
        }
      } catch (error) {
        ToastMessage.showError("Failed to fetch site info");
        setIsLoading(false);
      }
    };
    siteInfo();
  }, []);

  return (
    <>
      <div className="footerback m-0 mt-5 pt-3 shadow-sm">
        <Container>
          <Row className="px-0 my-5">
            <Col className="p-2" lg={3} md={3} sm={6} xs={12}>
              {isLoading ? (
                <Spinner
                  animation="border"
                  variant="primary"
                  role="status"
                  className="d-block mx-auto my-3"
                >
                  <span className="sr-only">Loading...</span>
                </Spinner>
              ) : (
                <>
                  <h5 className="footer-menu-title">OFFICE ADDRESS</h5>
                  {parse(address)}
                  <h5 className="footer-menu-title">SOCIAL LINK</h5>
                  <a href={facebookLink} target="_blank" rel="noreferrer">
                    <i className="fab m-1 h4 fa-facebook"></i>
                  </a>
                  <a href={instagramLink} target="_blank" rel="noreferrer">
                    <i className="fab m-1 h4 fa-instagram"></i>
                  </a>
                  <a href={twitterLink} target="_blank" rel="noreferrer">
                    <i className="fab m-1 h4 fa-twitter"></i>
                  </a>
                </>
              )}
            </Col>

            <Col className="p-2" lg={3} md={3} sm={6} xs={12}>
              <h5 className="footer-menu-title">THE COMPANY</h5>
              <Link to="/about" className="footer-link">
                About Us
              </Link>
              <br />
              <Link to="/" className="footer-link">
                Company Profile
              </Link>
              <br />
              <Link to="/contact" className="footer-link">
                Contact Us
              </Link>
              <br />
            </Col>

            <Col className="p-2" lg={3} md={3} sm={6} xs={12}>
              <h5 className="footer-menu-title">MORE INFO</h5>
              <Link to="/purchase" className="footer-link">
                How To Purchase
              </Link>
              <br />
              <Link to="/privacy" className="footer-link">
                Privacy Policy
              </Link>
              <br />
              <Link to="/refund" className="footer-link">
                Refund Policy
              </Link>
              <br />
            </Col>

            <Col className="p-2" lg={3} md={3} sm={6} xs={12}>
              <h5 className="footer-menu-title">DOWNLOAD APPS</h5>
              <a
                href={androidAppLink}
                target="_blank"
                rel="noopener noreferrer"
              >
                <img src={Google} alt="Download on Google Play" />
              </a>
              <br />
              {/* noopener: Prevents the new page from being able to control the original window object, which is a common vulnerability. */}
              {/* noreferrer: Provides additional privacy by not sending referrer information to the new page. */}
              <a href={iosAppLink} target="_blank" rel="noopener noreferrer">
                <img
                  className="mt-2"
                  src={Apple}
                  alt="Download on the App Store"
                />
              </a>
              <br />

              <div id="google_translate_element"></div>
            </Col>
          </Row>
        </Container>

        <Container fluid={true} className="text-center m-0 pt-3 pb-1 bg-dark">
          <Container>
            <Row>
              <h6 className="text-white">{parse(copyrightText)}</h6>
            </Row>
          </Container>
        </Container>
      </div>
    </>
  );
};

export default FooterDesktop;
