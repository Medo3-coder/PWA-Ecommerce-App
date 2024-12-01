import React, { useEffect, useState } from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import { Link } from "react-router-dom";
// import Button from "react-bootstrap/Button";
import Card from "react-bootstrap/Card";
import axios from "axios";
import AppURL from "../../utils/AppURL";
import ToastMessages from "../../toast-messages/toast";

function FeaturedProducts() {
  const [productData, setProductData] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  // UseEffect to fetch products on mount
  useEffect(() => {
    const fetchFeaturedProducts = async () => {
      try {
        const response = await axios.get(AppURL.productByRemark("FEATURED"));
        setProductData(response.data);
      } catch (err) {
        setError(
          ToastMessages.showError(
            "Failed to load information. Please try again later."
          )
        );
      } finally {
        setLoading(false); // Ensure loading stops in both success and error cases
      }
    };

    fetchFeaturedProducts();
  }, []);

  if (loading) {
    return (
      <Container className="text-center">
        <h4>Loading Featured Products...</h4>
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


  const renderProducts = productData.map((product , index) => {
    return (
    <Col className="p-1" key={index} xl={2} lg={2} md={2} sm={4} xs={6}>
      <Link to="/product-details">
        <Card className="image-box">
          <Card.Img className="center" src={product.image} alt={product.title} />
          <Card.Body>
            <p className="product-name-on-card">{product.title}</p>
            {product.special_price === "na" ? (
               <p className="product-price-on-card">Price : ${product.price}</p>
            ): (
              <p className="product-price-on-card">
                Price : <del className="text-secondary">${product.price}</del > ${product.special_price}
              </p>

            )}
          </Card.Body>
        </Card>
      </Link>
    </Col>
    )
  })

  return (
    <>
    <Container className="text-center" fluid={true}>
      <div className="section-title text-center mb-55">
        <h2>Featured Product</h2>
        <p>Some Of Our Exclusive Collection , You May Like</p>
      </div>
      <Row>{renderProducts}</Row>
    </Container>
    </>
  );
}

export default FeaturedProducts;
