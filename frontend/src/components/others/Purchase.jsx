import React, { Fragment, useEffect, useState } from "react";
import { Container, Row, Col, Spinner } from "react-bootstrap";
import AppURL from "../../utils/AppURL";
import parse from "html-react-parser";
import axios from "axios";

const Purchase = () => {
  const [purchase, setPurchase] = useState("");
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");

  useEffect(() => {
    const purchaseData = async () => {
      try {
        const response = await axios.get(AppURL.SiteSettings);
        if (response.status === 200) {
          const purchaseText =
            response.data[0]?.purchase_guide || "Information not available";
          setPurchase(purchaseText);
        }
      } catch (error) {
        setError("Failed to load information. Please try again later.");
      } finally {
        setLoading(false);
      }
    };

    purchaseData();
  }, []);

  return (
    <>
      <Container>
        <Row className="p-2">
          <Col
            className="shadow-sm bg-white mt-2"
            md={12}
            lg={12}
            sm={12}
            xs={12}
          >
            <h4 className="section-title-login">Purchase Page</h4>
            <p className="section-title-contact">
              {loading ? (
                <Spinner animation="border" variant="primary" />
              ) : error ? (
                <p className="text-danger"> {error}</p>
              ) : (
                <p className="section-title-contact">{parse(purchase)} </p>
              )}
            </p>
          </Col>
        </Row>
      </Container>
    </>
  );
};

export default Purchase;
