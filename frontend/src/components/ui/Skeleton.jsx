import React from "react";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css";

export const ContentSkeleton = ({ count = 5, height = 40 }) => (
  <Skeleton count={count} height={height} />
); 