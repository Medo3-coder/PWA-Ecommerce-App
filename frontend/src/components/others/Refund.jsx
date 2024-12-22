import axios from "axios";
import React, { useEffect, useState } from "react";
import { Container, Row, Col, Spinner } from "react-bootstrap";
import AppURL from "../../utils/AppURL";
import parse from "html-react-parser";
import ToastMessages from "../../toast-messages/toast";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css"; // Import the required styles

const Refund = () => {
  const [refund, setRefund] = useState("");
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const Refund = async () => {
      try {
        const response = await axios.get(AppURL.SiteSettings);
        if (response.status === 200) {
          const refundText =
            response.data[0]?.refund || "Information not available";
          setRefund(refundText);
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

    Refund();
  }, []); // Empty dependency array ensures it runs only on mount or refresh

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
            {/* <h4 className="section-title-login">Refund Page</h4> */}
            {loading ? (
              <Skeleton count={6} height={40} />
            ) : error ? (
              <p className="text-danger">{error}</p>
            ) : (
              <p className="section-title-contact">{parse(refund)}</p>
            )}
          </Col>
        </Row>
      </Container>
    </>
  );
};

export default Refund;
