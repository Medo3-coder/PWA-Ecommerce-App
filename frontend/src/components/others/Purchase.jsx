import React, { Fragment, useEffect, useState } from "react";
import { Container, Row, Col } from "react-bootstrap";
import AppURL from "../../utils/AppURL";
import parse from "html-react-parser";
import axios from "axios";
import Breadcrumb from "react-bootstrap/Breadcrumb";
import ToastMessages from "../../toast-messages/toast";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css"; // Import the required styles
import { Link } from "react-router-dom";

const Purchase = () => {
  const [purchase, setPurchase] = useState("");
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");

  useEffect(() => {
    const purchaseData = async () => {
      try {
        // const cahcedPurchaseText = localStorage.getItem("purchaseText");
        // if(cahcedPurchaseText){
        //   setPurchase(cahcedPurchaseText);
        //   setLoading(false);
        //   return;
        // }

        const response = await axios.get(AppURL.SiteSettings);
        if (response.status === 200) {
          const purchaseText =
            response.data[0]?.purchase_guide || "Information not available";
          setPurchase(purchaseText);
          // localStorage.setItem("purchaseText" , purchaseText);
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

    purchaseData();
  }, []);

  return (
    <>
      <Container>
      <div className="breadbody">
        <Breadcrumb>
          <Breadcrumb.Item ><Link className="text-link" to={`/`}>Home</Link></Breadcrumb.Item>
          <Breadcrumb.Item ><Link className="text-link" to={`/purchase`}>Purchase</Link></Breadcrumb.Item>
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
            <h4 className="section-title-login">Purchase Page</h4>
            <p className="section-title-contact">
              {loading ? (
                <Skeleton count={8} height={40} />
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
