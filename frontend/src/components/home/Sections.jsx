import React, { useEffect, useState } from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Card from "react-bootstrap/Card";
import axios from "axios";
import AppURL from "../../utils/AppURL";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css";
import { Link } from "react-router-dom";

function Sections() {
  const [sections, setSections] = useState({});
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchSections = async () => {
      try {
        const response = await axios.get(AppURL.HomepageSections);
        setSections(response.data);
      } catch (err) {
        setError("Failed to load sections. Please try again later.");
      } finally {
        setLoading(false);
      }
    };
    fetchSections();
  }, []);

  const renderSkeletons = (count = 8) =>
    Array.from({ length: count }).map((_, index) => (
      <Col className="p-0" key={index} xl={3} lg={3} md={3} sm={6} xs={6}>
        <Card className="image-box w-100">
          <Card.Body>
            <Skeleton
              className="center"
              style={{ width: "75%", height: "150px", margin: "0 auto" }}
            />
            <h5 className="product-name-on-card">
              <Skeleton width="80%" />
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
          <h2>Loading Sections...</h2>
        </div>
        <Row>{renderSkeletons()}</Row>
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

  return (
    <Container className="text-center" fluid={true}>
      {Object.entries(sections).map(([sectionName, products]) => (
        <div key={sectionName} className="mb-5">
          <div className="section-title text-center mb-4">
            <h2>{sectionName.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())}</h2>
          </div>
          <Row>
            {products.length === 0 ? (
              <Col>
                <p>No products found in this section.</p>
              </Col>
            ) : (
              products.map((product, index) => (
                <Col className="p-0" key={index} xl={3} lg={3} md={3} sm={6} xs={6}>
                  <Link className="text-link" to={`/product-details/${product.id}`}>
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
                            Price : <del className="text-secondary">${product.price}</del> ${product.special_price}
                          </p>
                        )}
                      </Card.Body>
                    </Card>
                  </Link>
                </Col>
              ))
            )}
          </Row>
        </div>
      ))}
    </Container>
  );
}

export default Sections; 