import React, { useEffect, useState } from "react";
import AppURL from "../../utils/AppURL";
import axios from "axios";
import Skeleton from "react-loading-skeleton";
import { Link } from "react-router-dom";

const MegaMenuMobile = () => {
  const [categories, setCategories] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchCategories = async () => {
      try {
        const response = await axios.get(AppURL.CategoryDetails);
        if (response.status === 200) {
          setCategories(response.data.data.categories);
        }
      } catch (error) {
        setError("Failed to load categories in Mega Menu");
        console.error("Error fetching categories:", error);
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

  useEffect(() => {
    const acc = document.getElementsByClassName("accordionMobile");

    // Add event listeners
    for (let i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", handleAccordionClick);
    }

    // Cleanup function to remove event listeners on component unmount
    return () => {
      for (let i = 0; i < acc.length; i++) {
        acc[i].removeEventListener("click", handleAccordionClick);
      }
    };
  }, [categories]); // Add categories as dependency to reattach listeners when data changes

  if (isLoading) {
    return (
      <div className="accordionMenuDivMobile">
        <Skeleton count={5} height={40} />
      </div>
    );
  }

  if (error) {
    return (
      <div className="accordionMenuDivMobile">
        <div className="text-danger">{error}</div>
      </div>
    );
  }

  return (
    <>
      <div className="accordionMenuDivMobile">
        {categories.length > 0 ? (
          categories.map((category) => (
            <div className="accordionMenuDivInsideMobile" key={category.id}>
              <button className="accordionMobile">
                {category.image && (
                  <img
                    className="accordionMenuIconMobile"
                    src="https://img.icons8.com/?size=50&id=53386&format=png"
                    alt="icon"
                  />
                )}
                &nbsp {category.name}
              </button>
              <div className="panelMobile">
                <ul>
                  {category.children &&
                    category.children.map((subcategory) => (
                      <li key={subcategory.id}>
                        <Link
                          to={`/categories/${subcategory.slug}`}
                          className="accordionItemMobile"
                        >
                          {subcategory.name}
                        </Link>
                      </li>
                    ))}
                </ul>
              </div>
            </div>
          ))
        ) : (
          <div className="text-center">No categories available</div>
        )}
      </div>
    </>
  );
};

export default MegaMenuMobile;
