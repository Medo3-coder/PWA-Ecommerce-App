import axios from "axios";
import React, { useEffect, useState } from "react";
import AppURL from "../../utils/AppURL";
import { Container } from "react-bootstrap";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css";
import { Link } from "react-router-dom";

const MegaMenuDesktop = () => {
  const [category, setCategory] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState(null);

  // Fetch category data when the component mounts
  useEffect(() => {
    const fetchCategories = async () => {
      try {
        const response = await axios.get(AppURL.CategoryDetails);
        if (response.status === 200) {
          setCategory(response.data.categories);
        }
      } catch (error) {
        setError("Failed to load categories in Mega Menu");
      } finally {
        setIsLoading(false);
      }
    };

    fetchCategories();
  }, []); // Empty dependency array to run only on mount and unmount

  // Define the event handler function separately
  const handleAccordionClick = (event) => {
    event.currentTarget.classList.toggle("active");
    const panel = event.currentTarget.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  };


  if(isLoading){
    return (
      <Container className="text-center">
       <Skeleton count={8} height={20} />
      </Container>
    );
  }

  return (
    <>
      <div className="accordionMenuDivAll">
        {error ? (
          <div className="text-danger">{error}</div>
        ) : category.length > 0 ? (
          category.map((item, index) => (
            <div className="accordionMenuDivInsideAll" key={index}>
              <button className="accordionAll" onClick={handleAccordionClick}>
                <img
                  className="accordionMenuIconAll"
                  src="https://img.icons8.com/?size=50&id=53386&format=png"
                  alt="icon"
                />
                &nbsp; {item.category_name}
              </button>
              <div className="panelAll">
                <ul>
                {item.subcategories.map((subcategory, subIndex) => (  
                    <li key={subIndex}>
                      <Link to={`/${item.slug}/${subcategory.slug}`} className="accordionItemAll">
                        {subcategory.subcategory_name}
                      </Link>
                    </li>
                  ))}
                </ul>
              </div>
            </div>
          ))
        ) : (
          <div>No categories available.</div>
        )}
      </div>
    </>
  );
};

export default MegaMenuDesktop;
