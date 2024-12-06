import React, { useEffect } from "react";
import { Link } from "react-router-dom";

const MegaMenu = ({ data }) => {
  // Define the event handler function separately
  const handleAccordionClick = (event) => {
    // Toggle the active class on the clicked accordion button
    event.currentTarget.classList.toggle("active");

    // Get the panel next to the clicked accordion button
    const panel = event.currentTarget.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null; // Close the panel
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px"; // Open the panel with smooth transition
    }
  };

  useEffect(() => {
    const acc = document.getElementsByClassName("accordion");

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
  }, []); // Empty dependency array to run only on mount and unmount

  return (
    <div className="accordionMenuDiv">
      <div className="accordionMenuDivInside">
        {data.map((item, index) => (
          <div key={index}>
            <button className="accordion">
              <img
                className="accordionMenuIcon"
                src={item.category_image}
                alt="icon"
              />
              &nbsp; {item.category_name}
            </button>
            <div className="panel">
              <ul>
                {item.subcategories.map((subcategory, subIndex) => (
                  <li key={subIndex}>
                    <Link to={`/${item.slug}/${subcategory.slug}`} className="accordionItem">
                      {subcategory.subcategory_name}
                    </Link>
                  </li>
                ))}
              </ul>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default MegaMenu;
