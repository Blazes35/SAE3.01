import React from "react";
import ellipse4 from "./ellipse-4.svg";
import "./style.css";

export const Box = () => {
  return (
    <div className="box">
      <img className="ellipse" alt="Ellipse" src={ellipse4} />
    </div>
  );
};