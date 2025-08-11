import { AgendaData } from "./generated";

export interface PaginatedData {
    data: Array;
    links: Array;
    meta: {
        current_page?: number;
        first_page_url?: String;
        from?: Number;
        last_page?: number;
        last_page_url?: String;
        next_page_url?: String;
        path?: String;
        per_page?: Number;
        prev_page_url?: String;
        to?: Number;
        total?: Number;
    };
}

export enum FlahserType {
    success = "success",
    error = "error",
    warning = "warning",
    info = "info",
}

export enum OrderDataBy {
    asc = "asc",
    desc = "desc",
}

export interface RoomHotel {
    id: string;
    price: number;
    title: string;
    description: string;
    email:string;
    contact:string;
    images: Array<File>;
}

export interface Provinces extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.ProvinceData>;
}

export interface Cities extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.CityData>;
}

export interface Neighborhoods extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.NeighborhoodData>;
}

export interface Mails extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.AgendaData>;
}

export interface BusinessRulesData extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.BusinessRuleData>;
}

export interface Statuses extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.StatusData>;
}

export interface Conditions extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.ConditionData>;
}

export interface Banners extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.MediaData>;
}

export interface TransactionTypes extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.TransactionTypeData>;
}

export interface Users extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.UserData>;
}

export interface PropertyTypes extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.PropertyTypeData>;
}
export interface Intermediations extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.IntermediationRuleData>;
}

export interface Propertys extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.PropertyData>;
}
export interface PropertyImages extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.MediaData>;
}

export interface Hotels extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.HotelMetaDataDtoData>;
}
export interface Attributes extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.AttributeData>;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: App.Data.UserData;
    };
    site: {
        type: String;
    };
    mails: {
        type: Number;
    };
    trash: {
        type: Number;
    };
    notAprrovedPropertys: {
        type: Number;
    };
    globals: App.Data.PageData;
    roles: {
        type: Array<App.Data.RoleData>;
    };
};
