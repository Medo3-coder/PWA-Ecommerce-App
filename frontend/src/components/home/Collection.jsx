import React, { useEffect, useState } from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
// import Button from "react-bootstrap/Button";
import Card from "react-bootstrap/Card";
import axios from "axios";
import AppURL from "../../utils/AppURL";
import ToastMessages from "../../toast-messages/toast";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css";
import { Link } from "react-router-dom";

function Collection() {
  const [productData, setProductData] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  // UseEffect to fetch products on mount
  useEffect(() => {
    const fetchCollectionProducts = async () => {
      try {
        const response = await axios.get(AppURL.productByRemark("Collection"));
        setProductData(response.data);
      } catch (error) {
        setError(
          ToastMessages.showError(
            "Failed to load information. Please try again later."
          )
        );
      } finally {
        setLoading(false); // Ensure loading stops in both success and error cases
      }
    };

    fetchCollectionProducts();
  }, []);

  const renderSkeletons = Array.from({ length: 8 }).map((_, index) => (
    <Col className="p-0" key={index} xl={3} lg={3} md={3} sm={6} xs={6}>
      <Card className="image-box w-100">
        <Card.Body>
          <Skeleton
            className="center"
            style={{ width: "75%", height: "150px", margin: "0 auto" }}
          />
          <h5 className="product-name-on-card">
            <Skeleton with="80%" />
          </h5>
          <p className="product-price-on-card">
            <Skeleton width="60%" />
          </p>
        </Card.Body>
      </Card>
    </Col>
  ));

  if (loading) {
    return (
      <Container className="text-center" fluid={true}>
        <div className="section-title text-center mb-55">
          <h2>Product Collection</h2>
        </div>
        <Row>{renderSkeletons}</Row>
      </Container>
    );
  }

  if (error) {
    return (
      <Container className="text-center">
        <h4>{error}</h4>
      </Container>
    );
  }

  const renderProducts = productData.map((product, index) => {
    return (
      <Col className="p-0" key={index} xl={3} lg={3} md={3} sm={6} xs={6}>
        <Link to={`/product-details/${product.id}`} >
        <Card className="image-box w-100">
          <Card.Body>
            <Card.Img
              className="center w-75"
              src={product.image}
              alt={product.title}
            />
            <h5 className="product-name-on-card">{product.title}</h5>
            {product.special_price === "na" ? (
              <p className="product-price-on-card">Price : ${product.price}</p>
            ) : (
              <p className="product-price-on-card">
                Price : <del className="text-secondary">${product.price}</del> $
                {product.special_price}
              </p>
            )}
          </Card.Body>
        </Card>
        </Link>
      </Col>
    );
  });

  return (
    <Container className="text-center" fluid={true}>
      <div className="section-title text-center mb-55">
        <h2>Product Collection</h2>
      </div>
      <Row>{renderProducts}</Row>
    </Container>
  );
}

export default Collection;
