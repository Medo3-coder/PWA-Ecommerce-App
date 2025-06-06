import React from "react";
import { Card, Col, Container, Row } from "react-bootstrap";
import { Link } from "react-router-dom";
import Breadcrumb from "react-bootstrap/Breadcrumb";

const ProductCard = ({ product }) => (
  <Col className="p-0" xl={3} lg={3} md={3} sm={6} xs={6}>
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
            <p className="product-price-on-card">
              Price : ${product.price}
            </p>
          ) : (
            <p className="product-price-on-card">
              Price :{" "}
              <del className="text-secondary">${product.price}</del> $
              {product.special_price}
            </p>
          )}
        </Card.Body>
      </Card>
    </Link>
  </Col>
);

const SearchList = ({ ProductData = [], SearchKey, isLoading }) => {
  const renderBreadcrumb = () => (
    <div className="breadbody">
      <Breadcrumb>
        <Breadcrumb.Item>
          <Link className="text-link" to="/">
            Home
          </Link>
        </Breadcrumb.Item>
        <Breadcrumb.Item>Search Results for: {SearchKey}</Breadcrumb.Item>
      </Breadcrumb>
    </div>
  );

  const renderProducts = () => {
    if (isLoading) {
      return (
        <Col className="text-center py-5">
          <div className="spinner-border text-primary" role="status">
            <span className="visually-hidden">Loading...</span>
          </div>
        </Col>
      );
    }

    if (ProductData.length === 0) {
      return (
        <Col className="text-center py-5">
          <h5>No products found for "{SearchKey}"</h5>
        </Col>
      );
    }

    return ProductData.map((product, index) => (
      <ProductCard key={product.id || index} product={product} />
    ));
  };

  return (
    <Container className="text-center" fluid={true}>
      {renderBreadcrumb()}
      <div className="section-title text-center mb-40 mt-2">
        <h2>Results for "{SearchKey}"</h2>
      </div>
      <Row>{renderProducts()}</Row>
    </Container>
  );
};

export default SearchList;