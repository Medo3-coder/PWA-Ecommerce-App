import axios from "axios";
import React, { Fragment, useEffect, useState } from "react";
import { Container, Row, Col } from "react-bootstrap";
import AppURL from "../../utils/AppURL";
import parse from "html-react-parser";
import Breadcrumb from "react-bootstrap/Breadcrumb";
import ToastMessages from "../../toast-messages/toast";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css"; // Import the required styles
import { Link } from "react-router-dom";

const Privacy = () => {
  const [privacy, setPrivacy] = useState("");
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(true);

  // By placing the API call inside useEffect, you ensure that the data is fetched only when the component is first rendered,
  // not on every re-render.
  useEffect(() => {
    const privacyData = async () => {
      try {
        // Check if data is in localStorage
        const cachedPrivacyText = localStorage.getItem("privacyText");
        if (cachedPrivacyText) {
          setPrivacy(cachedPrivacyText);
          setLoading(false);
          return;
        }

        const response = await axios.get(AppURL.SiteSettings);
        if (response.status === 200) {
          const privacyText = response.data[0]?.privacy || "Information not available";
          setPrivacy(privacyText);
          //This approach allows you to benefit from the speed and efficiency of localStorage while minimizing the risk of displaying outdated information.
          localStorage.setItem("privacyText", privacyText);
        }
      } catch (error) {
        setError(ToastMessages.showError("Failed to load information. Please try again later."));

      } finally {
        // code inside the finally block will always execute, whether the request succeeded (try block) or failed (catch block).
        setLoading(false);
      }
    };

    privacyData();
  }, []);
  return (
    <Fragment>
      <Container>
      <div className="breadbody">
        <Breadcrumb>
          <Breadcrumb.Item ><Link className="text-link" to={`/`}>Home</Link></Breadcrumb.Item>
          <Breadcrumb.Item ><Link className="text-link" to={`/privacy`}>Privacy</Link></Breadcrumb.Item>
        </Breadcrumb>
        </div>

        <Row className="p-2">
          <Col
            className="shadow-sm bg-white mt-2"
            md={12}
            lg={12}
            sm={12}
            xs={12}
          >
            <h4 className="section-title-login">privacy Page</h4>
            {loading ? (
             <Skeleton count={5} height={100} />
            ) : error ? (
              <p className="text-danger">{error}</p>
            ) : (
              <p className="section-title-contact">{parse(privacy)}</p>
            )}
          </Col>
        </Row>
      </Container>
    </Fragment>
  );
};

export default Privacy;
