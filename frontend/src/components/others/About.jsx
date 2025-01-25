import React, { Fragment, useEffect, useState } from "react";
import { Container, Row, Col } from "react-bootstrap";
import AppURL from "../../utils/AppURL";
import axios from "axios";
import parse from "html-react-parser";
import ToastMessages from "../../toast-messages/toast";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css"; // Import the required styles
import Breadcrumb from "react-bootstrap/Breadcrumb";
import { Link } from "react-router-dom";

const About = () => {
  const [about, setAbout] = useState("");
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");

  //useEffect runs when the component is mounted, making it ideal for fetching data or performing other operations that should only occur once.
  useEffect(() => {
    const AboutInfo = async () => {
      try {
        const response = await axios.get(AppURL.SiteSettings);
        if (response.status === 200) {
          const aboutText =
            response.data[0]?.about || "Information not available";
          setAbout(aboutText);
        }
      } catch (error) {
        setError(
          ToastMessages.showError(
            "Failed to load information. Please try again later."
          )
        );
      } finally {
        setLoading(false);
      }
    };

    AboutInfo();
  }, []);

  

  return (
    <Fragment>
      <Container>
        <div className="breadbody">
        <Breadcrumb>
          <Breadcrumb.Item ><Link className="text-link" to={`/`}>Home</Link></Breadcrumb.Item>
          <Breadcrumb.Item ><Link className="text-link" to={`/about`}>about</Link></Breadcrumb.Item>
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
            <h4 className="section-title-login">About Us</h4>
            {loading ? (
              <Skeleton count={5} height={40} />
            ) : error ? (
              <p className="text-danger">{error}</p>
            ) : (
              <p className="section-title-contact">{parse(about)} </p>
            )}
          </Col>
        </Row>
      </Container>
    </Fragment>
  );
};

export default About;
