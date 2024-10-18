import axios from "axios";
import React, { Fragment, useEffect, useState } from "react";
import { Container, Row, Col, Spinner } from "react-bootstrap";
import AppURL from "../../utils/AppURL";
import parse from "html-react-parser";

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
        setError("Failed to load information. Please try again later.");
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
              <Spinner animation="border" variant="primary" />
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
